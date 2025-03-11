# Medik

Lo primero de todo copia el .env.example a .env

El administrador por defecto es:
'name' => 'Administrador',
'apellido' => 'Total',
'email' => 'administradorTotal@gmail.com',
'password' => Hash::make('adminTotal123!'),
'nif' => '11111111A',

Recuerda que esta página utiliza jetstream, cambia estos datos al env:
MAIL_USERNAME=${api-mailjet}
MAIL_PASSWORD=${apisecret-mailjet}
MAIL_FROM_ADDRESS=${correo-mailjet}
MAILJET_APIKEY=${api-mailjet}
MAILJET_APISECRET=${apisecret-mailjet}
