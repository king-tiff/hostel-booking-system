<template>
    <div class="p-6 bg-white rounded-lg shadow-md mb-6">
      <h2 class="text-2xl font-bold mb-4">Message Center</h2>
      <ul class="space-y-4">
        <li v-for="message in messages" :key="message.id" class="p-4 bg-gray-100 rounded-lg shadow">
          <h3 class="text-lg font-semibold">{{ message.sender }}</h3>
          <p class="mt-2">{{ message.text }}</p>
          <span class="text-gray-500 text-sm">{{ message.date }}</span>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    name: 'MessageCenter',
    data() {
      return {
        messages: [
          { id: 1, sender: 'John Doe', text: 'I would like to know more about the amenities.', date: '2024-05-20' },
          { id: 2, sender: 'Jane Smith', text: 'Can I extend my stay?', date: '2024-05-21' },
          { id: 3, sender: 'Mike Johnson', text: 'What is the check-in time?', date: '2024-05-22' },
        ],
      };
    },
  };
  </script>
  
  <style scoped>
  </style>
  