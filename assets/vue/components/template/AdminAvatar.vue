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
  <Button data-bs-toggle="modal" :data-bs-target="`#${formId}`" :label="avatarImg ? 'modifier' : 'ajouter'" color-class="warning" type="button" round-class="pill"/>
  <Avatar v-if="avatarImg" :avatar-img="avatarImg"/>
</template>

<style scoped>

</style>