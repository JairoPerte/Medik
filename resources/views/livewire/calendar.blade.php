<div>
    <div id="calendar"></div>

    @push('styles')
        <style>
            .fc-event {
                color: white !important;
                cursor: pointer;
            }

            .fc-col-header-cell {
                background-color: #007bff !important;
                color: white !important;
                font-weight: bold;
            }

            #calendar {
                margin: 20px auto;
                width: 90%;
            }

            .fc-daygrid-day-number {
                font-size: 14px;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale: 'es',
                    events: @json($citas),
                    eventClick: function(info) {
                        // Obtener la descripción de la cita
                        var descripcion = info.event.extendedProps.descripcion;

                        // Mostrar la descripción en un alert o en un modal
                        alert('Descripción de la cita: ' + descripcion); // O aquí podrías abrir un modal
                    }
                });
                calendar.render();
            });
        </script>
    @endpush
</div>
