<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = 'servicio';
    protected $primaryKey = 'id_servicio';

    protected $fillable = [
        'costo_total',
        'estado',
        'fecha_hora',
        'hora_salida',
        'observaciones',
        'id_ambulancia',
        'id_cliente'
    ];

     // Un servicio tiene una ambulancia
    public function ambulancia()
    {
        return $this->belongsTo(Ambulancia::class, 'id_ambulancia');
    }

    // Un servicio pertenece a un cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    
    public function insumo(){
        return $this->belongsToMany(
            Insumo::class,
            'Servicio_Insumo',
            'id_servicio',
            'id_insumo'
        );
    }

    public function paramedico(){
        return $this->belongsToMany(
            Paramedico::class,
            'Servicio_Paramedico',
            'id_servicio',
            'id_paramedico'
        );
    }

    public function operador(){
        return $this->belongsTo(operador::class, 'id_operador');
    }

    public function up(){
        DB::statement("
            CREATE VIEW vista_direcciones AS 
            SELECT d.nombre_calle, coalesce(d.n_exterior, 'S/N exterior'),
            coalesce(d.n_interior, 'S/N interior'), c.nombre_colonia, m.nombre_municipio
            from direccion d
            join colonia c on d.id_colonia = c.id_colonia
            join municipio m on c.id_municipio = m.id_municipio;
        ");

        DB::statement("
            CREATE VIEW operador_servicio AS
            select s.id_servicio, u.nombre, u.ap_paterno, ta.nombre_tipo from users u
            join operador o on u.id_usuario = o.id_usuario
            join ambulancia a on a.id_operador = o.id_usuario
            join tipo_ambulancia ta on a.id_tipo_ambulancia = ta.id_tipo_ambulancia
            join servicio s on s.id_ambulancia = a.id_ambulancia;
        ");

        //checar que si de bien la lista de padecimientos
        DB::statement("
            create view datos_traslado as
            SELECT s.costo_total, s.estado, s.fecha_hora, s.hora_salida, s.observaciones,
            os.nombre as nombre_operador, os.ap_paterno as apellido_operador, os.nombre_tipo,
            t.redondo, t.id_origen, t.id_destino,
            p.nombre as nombre_paciente, p.ap_paterno as paterno_paciente, p.ap_materno as materno_paciente, p.oxigeno, p.fecha_nacimiento, p.sexo, p.peso,
            pad.nombre_padecimiento,
            u.nombre, u.ap_materno, u.ap_paterno, u.telefono
            from servicio s
            join cliente c on s.id_cliente = c.id_cliente
            join users u on c.id_cliente = c.id_usuario
            join operador_servicio os on os.id_servicio = s.id_servicio
            join traslado t on t.id_servicio = s.id_servicio
            join paciente p on t.id_paciente = p.id_paciente
            join paciente_padecimiento pp on pp.id_paciente = p.id_paciente
            join padecimiento pad on pp.id_padecimiento = pad.id_padecimiento
        ");
    }

    public function down(){
        DB::statement("DROP VIEW IF EXISTS vista_direcciones");
        DB::statement("DROP VIEW IF EXISTS operador_servicio");
    }
}