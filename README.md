# Sistema de Gestión de Tickets - DFC

Este proyecto es una aplicación web desarrollada con **Laravel** para la gestión de tickets de soporte, incluyendo autenticación, manejo de usuarios y un módulo de notificaciones por correo electrónico transaccional.

---

## 🚀 Características e Implementaciones Recientes

### 1. Módulo de Registro y Notificaciones
- **Procesamiento de Usuarios:** Control directo del flujo de alta mediante `RegisterController` sin desvíos indeseados al tablero principal.
- **Envío de Correos Asíncrono:** Implementación de la interfaz `ShouldQueue` en la clase `WelcomeUserMail`, permitiendo el procesamiento en segundo plano a través de las colas de Laravel (`queue:work`) para no demorar la respuesta al usuario.
- **Integración SMTP:** Configuración e integración exitosa con el servicio transaccional **Brevo SMTP** (Puerto 587 con cifrado TLS).

### 2. Seguridad y Buenas Prácticas
- Mantenimiento de credenciales sensibles fuera del control de versiones mediante el uso exclusivo de variables de entorno (`.env`).
- Inclusión de plantilla `.env.example` para replicación del entorno de desarrollo.

---

## 🛠️ Requisitos Previos e Instalación

1. **Clonar el repositorio:**
   ```bash
   git clone [https://github.com/diegofcfor-cell/sistema-tickets-DFC.git](https://github.com/diegofcfor-cell/sistema-tickets-DFC.git)
   cd sistema-tickets-DFC
