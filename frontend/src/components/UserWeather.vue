<script setup>
import { formatDistance } from "date-fns";
import { onBeforeMount, ref } from "vue";
import DetailedWeather from "./DetailedWeather.vue";

const isOpen = ref(false);

function closeModal() {
  isOpen.value = false;
}
function openModal(user) {
  selectedUser.value = user;
  isOpen.value = true;
}

const users = ref([]);
const selectedUser = ref(null);
const response = ref(null);
const timeToFetch = ref(0);

const timeAgo = (date) => {
  return formatDistance(new Date(date), new Date(), {
    includeSeconds: true,
  });
};

const fetchData = async () => {
  const url = "http://localhost/";
  try {
    let start = performance.now();
    const apiResponse = await fetch(url);
    let end = performance.now();
    timeToFetch.value = parseInt(end - start);
    const json = await apiResponse.json();
    response.value = json;
  } catch (e) {
    response.value = {
      users: [],
      message:
        "Failed to retrieve data from the server, please try again soon.",
    };
  }

  users.value = response.value.users.map((row) => ({
    id: row.id,
    email: row.email,
    name: row.name,
    currentWeather: row.weather.weather_main,
    weather: row.weather,
  }));
};

onBeforeMount(fetchData);
</script>

<template>
  <h1 class="text-3xl font-bold mt-4">Current User Weather</h1>
  <div v-if="!response">Loading user data...</div>
  <div
    v-if="response && !users.length"
    class="mt-4 font-italic p-4 bg-gray-100"
    v-html="response.message"
  ></div>

  <p class="text-sm mt-4">
    Showing {{ users.length }} of 20 in {{ timeToFetch }} milliseconds.
  </p>

  <div
    v-if="users.length"
    class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative mt-2"
  >
    <table
      class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative"
    >
      <thead>
        <tr class="text-left">
          <th
            class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100"
          >
            Name
          </th>
          <th
            class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100"
          >
            Weather
          </th>
          <th
            class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100"
          >
            Last Updated
          </th>
          <th
            class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100"
          ></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" :key="user.id" class="hover:bg-gray-100">
          <td class="p-2 border-t border-gray-200">
            {{ user.name }} <br />
            <span class="text-xs text-gray-500">{{ user.email }}</span>
          </td>
          <td class="p-2 border-t border-gray-200">
            {{ user.currentWeather }}
          </td>
          <td class="p-2 border-t border-gray-200">
            {{ timeAgo(user.weather.updated_at) }}
          </td>
          <td class="p-2 border-t border-gray-200">
            <button
              v-if="user.weather"
              type="button"
              @click="openModal(user)"
              class="rounded-md bg-blue-500 text-white px-2 py-1 text-sm font-medium hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
            >
              Details
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <DetailedWeather
    :isOpen="isOpen"
    :closeModal="closeModal"
    :user="selectedUser"
  ></DetailedWeather>
</template>
