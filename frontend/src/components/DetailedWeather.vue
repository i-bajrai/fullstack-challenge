<script setup>
import {
  Dialog,
  DialogPanel,
  DialogTitle,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";
import { defineProps } from "vue";
import DefinitionItem from "./DefinitionItem.vue";

const props = defineProps({
  user: Object,
  isOpen: Boolean,
  closeModal: Function,
});
</script>

<template>
  <TransitionRoot appear :show="isOpen" as="template">
    <Dialog as="div" @close="closeModal" class="relative z-10">
      <TransitionChild
        as="template"
        enter="duration-300 ease-out"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="duration-200 ease-in"
        leave-from="opacity-100"
        leave-to="opacity-0"
      >
        <div class="fixed inset-0 bg-black bg-opacity-25" />
      </TransitionChild>

      <div class="fixed inset-0 overflow-y-auto">
        <div
          class="flex min-h-full items-center justify-center p-4 text-center"
        >
          <TransitionChild
            as="template"
            enter="duration-300 ease-out"
            enter-from="opacity-0 scale-95"
            enter-to="opacity-100 scale-100"
            leave="duration-200 ease-in"
            leave-from="opacity-100 scale-100"
            leave-to="opacity-0 scale-95"
          >
            <DialogPanel
              class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
            >
              <DialogTitle
                as="h3"
                class="text-lg leading-6 text-gray-900 border-b pb-4"
              >
                Detailed Weather for <b>{{ user.name }}</b>
              </DialogTitle>
              <div class="mt-4">
                <div v-if="!user.weather" class="text-sm text-gray-500">
                  <p>No weather details available for this user.</p>
                </div>
                <div v-if="user.weather" class="text-sm text-gray-500">
                  <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                    <DefinitionItem
                      label="Main Weather"
                      :value="user.weather.weather_main"
                    />
                    <DefinitionItem
                      label="Weather Description"
                      :value="user.weather.weather_description"
                    />
                    <DefinitionItem
                      label="Temperature"
                      :value="`${user.weather.main_temp} K`"
                    />
                    <DefinitionItem
                      label="Feels Like"
                      :value="`${user.weather.main_feels_like} K`"
                    />
                    <DefinitionItem
                      label="Minimum Temperature"
                      :value="`${user.weather.main_temp_min} K`"
                    />
                    <DefinitionItem
                      label="Maximum Temperature"
                      :value="`${user.weather.main_temp_max} K`"
                    />
                    <DefinitionItem
                      label="Pressure"
                      :value="`${user.weather.main_pressure} hPa`"
                    />
                    <DefinitionItem
                      label="Humidity"
                      :value="`${user.weather.main_humidity} %`"
                    />
                    <DefinitionItem
                      label="Visibility"
                      :value="`${user.weather.visibility} m`"
                    />
                    <DefinitionItem
                      label="Wind Speed"
                      :value="`${user.weather.wind_speed} m/s`"
                    />
                    <DefinitionItem
                      label="Wind Direction"
                      :value="`${user.weather.wind_deg}°`"
                    />
                    <DefinitionItem
                      label="Wind Gust"
                      :value="`${user.weather.wind_gust} m/s`"
                    />
                    <DefinitionItem
                      label="Cloudiness"
                      :value="`${user.weather.clouds_all} %`"
                    />
                    <DefinitionItem
                      label="Country"
                      :value="user.weather.sys_country"
                    />
                    <DefinitionItem
                      label="Sunrise"
                      :value="user.weather.sys_sunrise"
                    />
                    <DefinitionItem
                      label="Sunset"
                      :value="user.weather.sys_sunset"
                    />
                    <DefinitionItem
                      label="Location Name"
                      :value="user.weather.name"
                    />
                  </dl>
                </div>
              </div>

              <div class="mt-6 flex justify-end">
                <button
                  type="button"
                  class="rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                  @click="closeModal"
                >
                  Close Details
                </button>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>
