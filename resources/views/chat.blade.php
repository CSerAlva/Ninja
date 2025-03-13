<script setup>
    import { ref } from 'vue';

    const ws = new WebSocket('ws://your-domain:7272');
    const messages = ref([]);
    const inputMsg = ref('');

    ws.onmessage  = (e) => {
        const data = JSON.parse(e.data);
        messages.value.push({
            id: Date.now(),
            content: data.content,
            from: data.from
        });
    };

    const sendMessage = () => {
        if(inputMsg.value.trim())  {
            ws.send(JSON.stringify({
                type: 'message',
                content: inputMsg.value
            }));
            inputMsg.value  = '';
        }
    };
</script>

<template>
    <div class="chat-box">
        <div v-for="msg in messages" :key="msg.id">
            [{{ msg.time  }}] {{ msg.from  }}: {{ msg.content  }}
        </div>
        <input v-model="inputMsg" @keyup.enter="sendMessage">
    </div>
</template>
