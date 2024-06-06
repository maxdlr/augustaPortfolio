<script setup>
import Button from "../../controllers/components/Button.vue";
import Avatar from "../molecule/Avatar.vue";
import {Modal} from 'bootstrap';
import {onMounted, ref} from "vue";
import HelpBox from "../atom/HelpBox.vue";

const props = defineProps({
  avatarImg: {type: Object, required: false},
  formId: {type: String, required: true}
})
const site = window.location.origin;

const currentAvatar = ref();

onMounted(() => {
  currentAvatar.value = props.avatarImg
})


const deleteMedia = async () => {
  if (confirm('Sure de vouloir supprimer ' + props.avatarImg.mediaPath + ' ?')) {
    await fetch(`${site}/media/${props.avatarImg.id}/delete`)
        .then(r => r.json().then(data => ({ok: r.ok, body: data}))
            .then(obj => {
              if (obj.ok) {
                console.log(obj.body.message);
              }
            }));
    currentAvatar.value = null
  }
}
</script>

<template>
  <div class="bg-white shadow rounded-5 position-relative pt-5 p-3 text-center">
    <div>
      <p class="fs-4 fw-bold text-info m-0 position-absolute top-0 start-0 ms-3 mt-3">Mon avatar</p>
      <div class="position-absolute top-0 end-0 me-3 mt-3 d-flex flex-column">
        <Button
            :color-class="currentAvatar ? 'warning' : 'primary'"
            :data-bs-target="`#${formId}`"
            :icon-class-start="currentAvatar ? 'pencil-fill' : 'plus-circle-fill'"
            :label="currentAvatar ? 'modifier' : 'ajouter'"
            data-bs-toggle="modal"
            round-class="pill"
            type="button"
        />
        <Button
            v-if="currentAvatar"
            color-class="danger"
            icon-class-start="trash-fill"
            label="supprimer"
            round-class="pill"
            @click.prevent="deleteMedia"
        />
      </div>
    </div>
    <Avatar v-if="currentAvatar" :avatar-img="currentAvatar"/>
    <div class="text-start">
      <HelpBox :instructions="[
      'Acceptés: .jpeg, .png, .webp, .gif',
        'L\'avatar est centré, donc si tu mets un format carré, t\'es tranquille'
    ]" :start-collapsed="true" class="mt-4"
      />
    </div>
  </div>
</template>

<style scoped>

</style>