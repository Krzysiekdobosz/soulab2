const API_URL = 'http://localhost:8000/api/contact';

export default {
  async submitForm(formData) {
    const response = await fetch(API_URL, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(formData),
    });
    return response.json();
  },

  async getMessages() {
    const response = await fetch(`${API_URL}/messages`);
    return response.json();
  },
};
