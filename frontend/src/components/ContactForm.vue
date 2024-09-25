<template>
  <form @submit.prevent="submitForm" class="w-full max-w-lg mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    <FormInput
      label="Imię:"
      name="firstName"
      v-model="form.firstName"
      :error="getError('firstName')"
    />
    <FormInput
      label="Nazwisko:"
      name="lastName"
      v-model="form.lastName"
      :error="getError('lastName')"
    />
    <FormInput
      label="E-mail:"
      name="email"
      type="email"
      v-model="form.email"
      :error="getError('email')"
    />
    <FormInput
      label="Treść wiadomości:"
      name="message"
      type="textarea"
      v-model="form.message"
      :error="getError('message')"
    />
    <div class="flex items-center justify-between">
      <button
        type="submit"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
      >
        Wyślij
      </button>
    </div>
  </form>
</template>

<script>
import { reactive } from 'vue';
import { useVuelidate } from '@vuelidate/core';
import { required, email } from '@vuelidate/validators';
import FormInput from './FormInput.vue';
import apiService from '../services/apiService';

export default {
  name: 'ContactForm',
  components: {
    FormInput,
  },
  setup(props, { emit }) {
    const form = reactive({
      firstName: '',
      lastName: '',
      email: '',
      message: '',
    });

    const rules = {
      firstName: { required },
      lastName: { required },
      email: { required, email },
      message: { required },
    };

    const v$ = useVuelidate(rules, form);

    const getError = (field) => {
      const fieldState = v$.value[field];
      if (fieldState.$dirty && !fieldState.required) {
        return 'Pole jest wymagane.';
      }
      if (field === 'email' && fieldState.$dirty && !fieldState.email) {
        return 'Niepoprawny adres e-mail.';
      }
      return '';
    };

    const submitForm = async () => {
      v$.value.$touch();
      if (!v$.value.$invalid) {
        try {
          const response = await apiService.submitForm(form);
          if (response.status === 'success') {
            // Czyszczenie formularza
            form.firstName = '';
            form.lastName = '';
            form.email = '';
            form.message = '';
            v$.value.$reset();

            // Emisja zdarzenia do rodzica
            emit('formSubmitted');
          } else {
            alert('Błąd podczas wysyłania formularza.');
            console.error('Błędy:', response.errors);
          }
        } catch (error) {
          console.error('Błąd podczas wysyłania formularza:', error);
        }
      }
    };

    return {
      form,
      v$,
      getError,
      submitForm,
    };
  },
};
</script>

<style scoped>
</style>
