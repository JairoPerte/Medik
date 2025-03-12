<div id="seccion-upper">
    <div id="botones">
        <form action="/user/historial-medico" method="get">
            <button>Ver Historial Medico</button>
        </form>

        |

        <form action="/user/recetas" method="get">
            <button>Ver Recetas Activas</button>
        </form>
    </div>
    @if (session('success'))
        <div id="success-message" style="color: green; transition: opacity 1s;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div id="error-message" style="color: red; transition: opacity 1s;">
            {{ session('error') }}
        </div>
    @endif
</div>

@livewire('calendar')

<script>
    document.addEventListener("DOMContentLoaded", function() {
        setTimeout(function() {
            let successMessage = document.getElementById('success-message');
            let errorMessage = document.getElementById('error-message');

            if (successMessage) {
                successMessage.style.opacity = '0';
                setTimeout(() => successMessage.style.display = 'none',
                    1000); // Elimina el elemento tras desvanecerse
            }

            if (errorMessage) {
                errorMessage.style.opacity = '0';
                setTimeout(() => errorMessage.style.display = 'none', 1000);
            }
        }, 2000); // Espera 2 segundos antes de iniciar la animación
    });
</script>

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
