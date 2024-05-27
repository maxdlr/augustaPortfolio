<script setup>
import Button from "../../controllers/components/Button.vue";
import Avatar from "../molecule/Avatar.vue";
import {Modal} from 'bootstrap';
const props = defineProps({
  avatarImg: {type: Object, required: false},
  formId: {type: String, required: true}
})
</script>

<template>
  <div class="bg-white shadow rounded-4 position-relative pt-5 p-3 text-center">
    <div >
      <p class="fs-4 fw-bold text-info m-0 position-absolute top-0 start-0 ms-3 mt-3">Mon avatar</p>
      <Button
          class="position-absolute top-0 end-0 me-3 mt-3"
          data-bs-toggle="modal"
          :data-bs-target="`#${formId}`"
          :label="avatarImg ? 'modifier' : 'ajouter'"
          color-class="warning"
          type="button"
          round-class="pill"
      />
    </div>
    <Avatar v-if="avatarImg" :avatar-img="avatarImg"/>
  </div>
</template>

<style scoped>

</style>