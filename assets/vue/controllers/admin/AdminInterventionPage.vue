<script setup>
import Button from "../components/Button.vue";
import {Modal} from 'bootstrap';

const props = defineProps({
  CVItems: {type: Object, default: null}
})
</script>

<template>

  <div v-for="item in CVItems" :key="item.id">
    {{ item.title }}
    <Button
        data-bs-toggle="modal"
        :data-bs-target="`#form-CVItem-${item.id}`"
        label="modifier"
        color-class="warning"
        type="button"
        round-class="pill"
    />
  </div>
</template>

<style scoped>

</style>