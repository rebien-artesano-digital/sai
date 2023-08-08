English

SAI (Sistema de Asistencia Inteligente)

SAI is a PHP library that allows you to create virtual assistants based on ChatGPT for SaaS applications. With SAI, you can control the functions of the SaaS application through natural language, allowing users to perform complex tasks more efficiently.

Installation

To install SAI, simply add the following code line to your composer.json:

Set up the access token (request it from the library manager).



br

After that, run the command `composer require assistent/sai` in your project.

Once the library is installed, run the following command:

`php artisan sai:install`

```
php artisan storage:link
```

Remember to configure this variable in your .env file:

```
OPENAI_API_KEY = "tu api key"
OPENAI_MODEL = "gpt-3.5-turbo" //puedes poner cualquier modelo
OPENAI_MAX_TOKEN = 200
```

With that, everything will be ready, and an automatic chat will be created, which will have integrated ChatGPT and the additional functionalities you wish to create.

Description

SAI is a powerful tool for creating virtual assistants that can understand natural language and perform complex tasks in SaaS applications. With its easy installation process and flexible configuration options, SAI allows developers to create intelligent and efficient chatbots that can enhance the user experience.

The installation process for SAI is straightforward and can be done in just a few steps. Once installed, developers can configure the library to work with their specific SaaS application and customize its functionality as needed.

SAI is based on ChatGPT, which is a state-of-the-art natural language processing tool that enables virtual assistants to understand and respond to user requests. With SAI, developers can harness the power of ChatGPT to create virtual assistants that can interact with users in a natural and intuitive way.

Overall, SAI is an excellent tool for developers who want to create virtual assistants for SaaS applications quickly and easily. Its powerful functionality and ease of use make it an ideal choice for any project that requires intelligent and efficient chatbots.

Español

SAI (Sistema de Asistencia Inteligente)

SAI es una librería de PHP que te permite crear asistentes virtuales basados en ChatGPT para aplicaciones SaaS. Con SAI, puedes controlar las funciones de la aplicación SAS a través del lenguaje natural, lo que permite a los usuarios realizar tareas complejas de manera más eficiente.

Instalación

Para instalar SAI, simplemente agrega la siguiente línea de código en tu archivo composer.json:

configura el token de acceso (solicitalo a manager de la libreria)

```json
composer require assistent/sai
```

Después de eso, ejecuta el comando composer require assistent/sai en tu proyecto.

Una vez instalada la librería, ejecuta el siguiente comando:

```
php artisan sai:install
```

```
php artisan storage:link
```

Recuerda configurar esta variable en tu archivo .env:

```
OPENAI_API_KEY = "tu api key"
OPENAI_MODEL = "gpt-3.5-turbo" //puedes poner cualquier modelo
OPENAI_MAX_TOKEN = 200
```

Con eso, todo estará listo, y se creará automáticamente un chat que tendrá integrado ChatGPT y las funcionalidades adicionales que desees crear.

Descripción

SAI es una herramienta potente para crear asistentes virtuales que pueden entender el lenguaje natural y realizar tareas complejas en aplicaciones SaaS. Con su proceso de instalación sencillo y sus opciones de configuración flexibles, SAI permite a los desarrolladores crear chatbots inteligentes y eficientes que pueden mejorar la experiencia del usuario.

El proceso de instalación de SAI es sencillo y puede realizarse en solo unos pocos pasos. Una vez instalado, los desarrolladores pueden configurar la librería para que funcione con su aplicación SaaS específica y personalizar su funcionalidad según sea necesario.

SAI se basa en ChatGPT, que es una herramienta de procesamiento de lenguaje natural de última generación que permite a los asistentes virtuales entender y responder a las solicitudes de los usuarios. Con SAI, los desarrolladores pueden aprovechar el poder de ChatGPT para crear asistentes virtuales que puedan interactuar con los usuarios de manera natural e intuitiva.

En general, SAI es una excelente herramienta para los desarrolladores que desean crear asistentes virtuales para aplicaciones SaaS de manera rápida y sencilla. Su funcionalidad potente y facilidad de uso lo convierten en una opción ideal para cualquier proyecto que requiera chatbots inteligentes y eficientes.
