<script setup>
import Button from "../components/Button.vue";
import {toTitle, truncate} from '../../composable/formatter/string'
import {Modal} from 'bootstrap';
import CVItem from "../../components/molecule/CVItem.vue";

const props = defineProps({
  CVItems: {type: Object, default: null}
})
</script>

<template>

  <div v-for="item in CVItems" :key="item.id">

    <div class="d-flex justify-content-start align-items-center">

      <CVItem :item="item" class="py-3 pe-3" />

      <Button
          data-bs-toggle="modal"
          :data-bs-target="`#form-CVItem-${item.id}`"
          label="modifier"
          color-class="warning"
          type="button"
          round-class="pill"
      />
    </div>
  </div>
</template>

<style scoped>

</style>