<template>
  <div class="sm:col-span-1" v-if="value">
    <dt class="text-sm font-medium text-gray-500">
      {{ label }}
    </dt>
    <dd class="mt-1 text-sm text-gray-900">
      {{ value }}
    </dd>
  </div>
</template>

<script>
export default {
  props: ["label", "value"],
};
</script>
