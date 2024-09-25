<template>
  <div>
    <ContactForm @formSubmitted="fetchMessages" />
    <MessageTable :messages="messages" />
  </div>
</template>

<script>
import ContactForm from './components/ContactForm.vue';
import MessageTable from './components/MessageTable.vue';
import apiService from './services/apiService';

export default {
  name: 'App',
  components: {
    ContactForm,
    MessageTable,
  },
  data() {
    return {
      messages: [],
    };
  },
  methods: {
    async fetchMessages() {
      this.messages = await apiService.getMessages();
    },
  },
  mounted() {
    this.fetchMessages();
  },
};
</script>

<style>
</style>
