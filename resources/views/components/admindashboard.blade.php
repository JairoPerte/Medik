<div id="seccion-upper">
    <div id="botones">
        <form action="/consultas" method="get">
            <button type="submit">Ir a Consultas</button>
        </form>
        <form action="/doctores" method="get">
            <button type="submit">Ir a Doctores</button>
        </form>
        <form action="/centro-medico" method="get">
            <button type="submit">Ir a Centro Medico</button>
        </form>
        <form action="/recetas" method="get">
            <button type="submit">Ir a Recetas</button>
        </form>
        <form action="/receta/create" method="get" id="obtener-cita">
            <select name="cita" id="cita-med">
                @foreach ($citas as $cita)
                    <option value="{{ $cita->id }}">{{ $cita->fecha_hora }}</option>
                @endforeach
            </select>
            <button type="submit">Nueva Receta de una Cita</button>
        </form>
    </div>
</div>

<style>
    #seccion-upper {
        margin: 20px auto;
        width: 90%;
    }

    #botones {
        color: wheat;
        display: flex;
        flex-direction: row;
        gap: 10px;
        flex-wrap: wrap;
        font-family: Arial, Helvetica, sans-serif
    }
</style>

<script>
    let form = document.getElementById("obtener-cita").addEventListener("submit", (evento) => {
        evento.preventDefault();
    });
</script>
