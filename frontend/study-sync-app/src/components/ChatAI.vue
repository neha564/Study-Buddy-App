<template>
  <div>
    <h2>AI Chat</h2>
    <input v-model="message" placeholder="Type your question" />
    <button @click="sendMessage">Send</button>
    <div v-if="response">
      <p><strong>Response:</strong> {{ response }}</p>
    </div>
  </div>
</template>

<script>
import api from "../api";

export default {
  data() {
    return {
      message: "",
      response: null,
      sessionId: "unique-session-id", // Replace with an actual unique identifier if needed
    };
  },
  methods: {
    async sendMessage() {
      try {
        const res = await api.post("/ai-chat", {
          sessionId: this.sessionId,
          message: this.message,
        });
        this.response = res.data.response;
      } catch (error) {
        console.error("Error sending message:", error);
      }
    },
  },
};
</script>
