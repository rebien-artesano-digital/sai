
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<style scoped>
    .floating-container {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background-color: #007bff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
      z-index: 9999;
    }

    .floating-button {
      width: 100%;
      height: 100%;
      color: #ffffff;
      font-size: 14px;
      font-weight: bold;
      text-align: center;
      cursor: pointer;
      border: none;
      background-color: transparent;
    }

    .chat-container {
      position: fixed;
      bottom: 100px;
      right: 20px;
      width: 38%;
      max-width: calc(100% - 40px);
      height: 410px;
      background-color: #ebe5e5;
      border-radius: 4px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
      overflow: hidden;
      font-family: Arial, sans-serif;
      z-index: 9999;
    }

    .chat-header {
      display: flex;
      justify-content: space-between;
      align-items: center; /* Alinea verticalmente los elementos en el centro */
      background-color: #000204;
      color: #ffffff;
      padding: 10px;
      font-size: 16px;
      font-weight: bold;
    }

    .chat-header span {
      flex-grow: 1; /* Permite que el <span> ocupe todo el espacio disponible */
    }

    .chat-header button {
      margin-left: 10px; /* Agrega un margen izquierdo para separar el botón del <span> */
    }

    .chat-messages {
      height: 68%;
      padding: 5px;
      overflow-y: scroll;
    }

    .chat-message {
      margin-bottom: 10px;
    }

    .chat-input-container {
      display: flex;
      align-items: center;
      padding: 10px;
      border-top: 1px solid #e0e0e0;
    }

    .chat-input {
      flex: 1;
      padding: 6px;
      border: none;
      border-radius: 4px;
      background-color: #f5f5f5;
    }

    .chat-send-button {
      margin-left: 10px;
      padding: 6px 12px;
      border: none;
      border-radius: 4px;
      background-color: #007bff;
      color: #ffffff;
      cursor: pointer;
    }

    .close-button {
      border: none;
      background-color: transparent;
      color: #ffffff;
      cursor: pointer;
      font-size: 16px;
      padding: 10px;
    }

    .chat-message-bot {
      background-color: #d8d5d5;
    }

    .chat-message-user {
      background-color: #b5c2e2;
      text-align: right;
    }


    .chat-message-text {
      margin: 0;
    }

    .chat-message img {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      margin-right: 10px;
    }

    @media (max-width: 480px) {
      /* Estilos para dispositivos móviles */
      .chat-container {
        width: 100%;
        /* Otros estilos para tamaños de pantalla más grandes */
      }
    }

    @media (min-width: 481px) and (max-width: 768px) {
      /* Estilos para tablets */
      .chat-container {
        width: 70%;
        /* Otros estilos para tamaños de pantalla más grandes */
      }
    }

    @media (min-width: 769px) {
      /* Estilos para portátiles y escritorios */
      .chat-container {
        width: 38%;
        /* Otros estilos para tamaños de pantalla más grandes */
      }
    }

    @media (min-width: 1200px) {
      /* Estilos para pantallas grandes */
      .chat-container {
        width: 38%;
        /* Otros estilos para tamaños de pantalla más grandes */
      }
    }

    .progress-circular {
        width: 24px;
        height: 24px;
        position: relative;
        border-radius: 50%;
        border: 2px solid #1976D2; /* Color del borde */
    }

    .progress-circular-inner {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        border-radius: 50%;
        border: 2px solid transparent;
        border-top-color: #1976D2; /* Color del progreso */
        animation: spin 1s linear infinite; /* Animación de rotación */
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

</style>



<div id="chat-body">
    <div class="floating-container d-flex justify-content-center align-items-center" :style="containerStyle" v-if="!chatOpen">
      <button class="floating-button" @click="handleButtonClick">
        <img src="{{ asset('storage/images/sai.png') }}" style="width: 100%; height: 100%; border-radius: 50%;" alt="Logo de nuestro asistente virtual" srcset="">
      </button>
    </div>

    <div v-if="chatOpen" class="chat-container">
      <div class="chat-header">
        <span>Sistema de Asistencia Inteligente (SAI)</span>
        <button class="close-button" @click="closeChat">×</button>
      </div>

      <div class="chat-messages">
        <div
          v-for="message in messages"
          class="chat-message"
          :key="message.id"
          :class="{'chat-message-bot': message.sender === 'bot', 'chat-message-user': message.sender === 'user'}"
        >
          <img :src="message.sender == 'bot' ? imageSai : imageUser" alt="">
          <p class="chat-message-text">@{{ message.content }}</p>
        </div>
        <div class="chat-message" v-show="consult">
          <img :src="imageSai" alt="">
          <div class="progress-circular">
            <div class="progress-circular-inner"></div>
          </div>
          <p class="chat-message-text">Procesando .....</p>
        </div>
      </div>
      <div class="chat-input-container">
        <input v-model="inputMessage" class="chat-input" placeholder="Escribe un mensaje" @keyup.enter="sendMessage">
        <button class="chat-send-button" @click="sendMessage">Enviar</button>
      </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.min.js"></script>
<script>

    const format = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: false, timeZone: 'America/Bogota' };
    // Inicializar la instancia de Vue.js
    var app = new Vue({
        el: '#chat-body',
        data: function() {
            return {
                consult: false,
                component: 'ChatBot',
                componentId:'ChatBot1',
                countPrinciples:false,
                principles:[],
                messages: [],
                imageUser: '/storage/images/intellisai.svg',
                imageSai: '/storage/images/sai.png',
                containerStyle: {
                    position: 'fixed',
                    bottom: '20px',
                    right: '20px',
                    zIndex: '9999',
                    transition: 'bottom 0.3s',
                },
                chatOpen: false,
                inputMessage: '',
            };
        },
        methods: {
            // Función para agregar un nuevo mensaje al chat
            addMessage(message) {
                this.messages.push(message);
                // Desplazarse al final del chat para mostrar el último mensaje
                this.$nextTick(() => {
                    const chatBody = document.querySelector('.chat-messages');
                    chatBody.scrollTop = chatBody.scrollHeight;
                });
            },
            handleScroll() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                this.containerStyle.bottom = scrollTop > 0 ? '20px' : '100px';
            },
            handleResize() {
                const screenWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
                if (screenWidth < 600) {
                    this.containerStyle.width = '60px';
                    this.containerStyle.height = '60px';
                } else {
                    this.containerStyle.width = '80px';
                    this.containerStyle.height = '80px';
                }
            },
            handleButtonClick() {
                this.chatOpen = !this.chatOpen;
            },
            sendMessage() {
                const message = this.inputMessage.trim();
                if (message !== '') {
                    this.messages.push({ id: Date.now(), sender: 'user', content: message , activeComponent:false, component: '' });
                    // Lógica para procesar la respuesta del chatbot
                    this.inputMessage = '';

                    this.$nextTick(() => {
                    const chatBody = document.querySelector('.chatbot-messages');
                    chatBody.scrollTop = chatBody.scrollHeight;
                    });

                    this.sendServices(message);
                }
            },
            sendServices(message){
                this.consult = true;
                axios.post('/sai', {
                    message: message,
                    alarm: true,
                    component:this.component,
                    clientId: localStorage.getItem('clientId'),
                })
                    .then(response => {

                    this.consult = false;
                    // Agregar la respuesta del servidor al chat
                    this.addMessage({
                        id:1,
                        sender: 'bot',
                        content: response.data.message,
                        link: '',
                        timestamp: new Date().toLocaleTimeString('es-ES',format)
                    });

                    this.$nextTick(() => {
                        const chatBody = document.querySelector('.chatbot-messages');
                        chatBody.scrollTop = chatBody.scrollHeight;
                    });
                    })
                    .catch(error => {
                    console.log(error);
                    });
            },
            closeChat() {
                this.chatOpen = false;
            },
        },
        mounted() {
            window.addEventListener('scroll', this.handleScroll);
            window.addEventListener('resize', this.handleResize);
            this.handleResize();
        },
        beforeUnmount() {
            window.removeEventListener('scroll', this.handleScroll);
            window.removeEventListener('resize', this.handleResize);
        },


    });
</script>

