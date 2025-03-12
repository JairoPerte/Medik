# Medik
----
Trabajo Realizado por Jairo Pertegal Carrasco, Miguel Gallardo Cota, 
Jaime Pérez Brotons, este trabajo se ha realizado para el proyecto Laravel de 2ºDAW 2024/2025
-
Las tres tecnologías que hemos utilizado para nuestro proyecto han sido las siguientes: Jetstream, Twilio, Full Calendar y Liveware.

---
DESCRIPCIÓN DEL PROYECTO
-
En esta web te podrás registrar como administrador o como usuario normal/paciente, el administrador puede crear nuevas citas médicas, asignar recetas y administrar la base de datos. Los pacientes tienen una vista de su calendario con las citas asignadas en dicho día y podrán ser avisados por sms y además pueden ver sus citas pendientes y pasadas, además de ver las recetas que tiene asignadas que no estén caducadas.

---
ANTES DE EMPEZAR
-
Recuerda instalarte las dependencias:
-> composer install
-> npm install
-> npm run dev
-> php artisan key:generate

Para la base de datos necesita CREAR UNA NUEVA DB LLAMADA MEDIK MANUALMENTE, y luego necesitará ejecutar las migraciones con los seeders ejecuta:
-> php artisan migrate:refresh --seed

Para iniciar como administrador en el login necesitas poner admin-email en el campo del email:
El Administrador por defecto tiene estos datos:
'name' => 'Administrador',
'apellido' => 'Total',
'email' => 'administradorTotal@gmail.com',
'password' => Hash::make('adminTotal123!'),
'nif' => '11111111A',

Lo primero de todo copia el .env.example a .env y necesitas cambiar los siguientes datos para la funcionalidad completa:

Configula el Mailjet para el envio de correos:
MAIL_USERNAME=${api-mailjet}
MAIL_PASSWORD=${apisecret-mailjet}
MAIL_FROM_ADDRESS=${correo-mailjet}
MAILJET_APIKEY=${api-mailjet}
MAILJET_APISECRET=${apisecret-mailjet}

Y Tambien configura tu Twilio, tambien al env:
TWILIO_SID=${twilio_sid}
TWILIO_AUTH_TOKEN=${twilio_auth_token}
TWILIO_PHONE=${wilio_phone_number}
