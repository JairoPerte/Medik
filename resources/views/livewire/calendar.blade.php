<div>
    <div id="calendar"></div>

    @push('styles')
        <style>
            .fc-event {
                cursor: pointer;
            }

            .fc-toolbar-title {
                color: whitesmoke;
            }

            .fc-col-header-cell {
                background-color: #007bff !important;
                color: white !important;
                font-weight: bold;
                border: 1px solid black !important;
            }

            .fc-col-header {
                border: 1px solid black !important;
            }

            .fc-day-today {
                background-color: rgb(193, 193, 108) !important;
                border: 1px solid black !important;
            }

            .fc-day-future {
                background-color: rgb(255, 239, 239) !important;
                border: 1px solid black !important;
            }

            .fc-day-past {
                background-color: rgb(223, 223, 223) !important;
                border: 1px solid black !important;
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
                        var now = new Date();
                        var eventStart = new Date(info.event.start);
                        var descripcion = info.event.extendedProps.descripcion;

                        if (eventStart > now) {
                            // Crear un formulario oculto
                            var form = document.createElement('form');
                            form.method = 'POST';
                            form.action = "{{ route('send.sms') }}";

                            // Agregar el token CSRF de Laravel
                            var csrfInput = document.createElement('input');
                            csrfInput.type = 'hidden';
                            csrfInput.name = '_token';
                            csrfInput.value = "{{ csrf_token() }}";
                            form.appendChild(csrfInput);

                            // Agregar el mensaje al formulario
                            var messageInput = document.createElement('input');
                            messageInput.type = 'hidden';
                            messageInput.name = 'message';
                            messageInput.value = descripcion;
                            form.appendChild(messageInput);

                            // Agregar el formulario al cuerpo y enviarlo
                            document.body.appendChild(form);
                            form.submit();
                        } else {
                            alert("Esta Cita ya ha preescrito");
                        }
                    }
                });
                calendar.render();
            });
        </script>
    @endpush

</div>
