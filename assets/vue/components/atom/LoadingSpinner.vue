<script setup>
defineProps({
  justifyContent: {type: String, default: 'center'},
  alignItems: {type: String, default: 'center'},
  type: {type: String, default: 'border'},
  colorClass: {type: String, default: 'primary'},
  size: {type: String, default: null},
});
</script>

<template>
  <div
      :class="`justify-content-${justifyContent} align-items-${alignItems}`"
      class="d-flex h-100 w-100"
  >
    <div
        :class="[
                `spinner-${type}`,
                `text-${colorClass}`,
                size === null ? '' : `spinner-${type}-${size}`,
            ]"
        role="status"
    >
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>
</template>
