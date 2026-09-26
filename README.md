Sistema de Gestión de Tickets (Laravel)

Este repositorio contiene la implementación del módulo de registro de usuarios y el sistema de notificaciones transaccionales vía correo electrónico utilizando la infraestructura de Brevo SMTP y el procesamiento en segundo plano con Laravel Queues.

🛠️ Tecnologías e Integraciones

Framework: Laravel

Lenguaje: PHP 8.x

Base de Datos: MySQL / MariaDB

Servidor SMTP: Brevo (Sendinblue)

Gestión de Colas: Laravel Queues (database driver)

🚀 Funcionalidades e Implementaciones Clave

Módulo de Registro Independiente:

Procesamiento de solicitudes de alta mediante RegisterController.

Aislamiento de flujo en la ruta /registro-mail evitando redirecciones automáticas o inicio de sesión forzado.

Envío de Correos Asíncrono (Queues):

Implementación de la clase Mailable WelcomeUserMail implementando la interfaz ShouldQueue.

Despacho diferido en la base de datos de colas para optimizar los tiempos de respuesta al cliente.

Integración con Servidor SMTP Transaccional:

Autenticación segura mediante TLS en el puerto 587 con Brevo SMTP.

📋 Pasos para la Evaluación y Pruebas Locales

Si deseas clonar y probar este repositorio en tu entorno local, sigue estos pasos:

1. Clonar el repositorio e instalar dependencias

git clone https://github.com/diegofcfor-cell/sistema-tickets-DFC.git
cd sistema-tickets-DFC
composer install
npm install && npm run build


2. Configuración del archivo de entorno .env

Copia el archivo de plantilla .env.example a .env:

cp .env.example .env


Genera la clave de aplicación e instancia las migraciones:

php artisan key:generate
php artisan migrate


3. Configurar Credenciales SMTP en .env

Asegúrate de completar los siguientes parámetros dentro de tu .env local con tus credenciales de Brevo:

MAIL_MAILER=smtp
MAIL_HOST=smtp-relay.brevo.com
MAIL_PORT=587
MAIL_USERNAME=tu_login_brevo
MAIL_PASSWORD=tu_smtp_key_brevo
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=tu_correo_verificado@dominio.com
MAIL_FROM_NAME="${APP_NAME}"


4. Probar el Envío de Correos y Colas

Inicia el servidor de desarrollo de Laravel:

php artisan serve


En una segunda terminal, ejecuta el procesador de colas (Worker):

php artisan queue:work


Navega a http://127.0.0.1:8000/registro-mail, completa el formulario de registro y observa en la consola del worker cómo se procesa la tarea App\Mail\WelcomeUserMail con estado DONE.

✒️ Autor

Diego F. C. - Desarrollo e Integración
