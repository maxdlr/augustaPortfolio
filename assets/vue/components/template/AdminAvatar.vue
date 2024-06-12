<script setup>
import Button from "../../controllers/components/Button.vue";
import Avatar from "../molecule/Avatar.vue";
import {Modal} from 'bootstrap';
import {onMounted, ref} from "vue";
import HelpBox from "../atom/HelpBox.vue";
import AdminDashboardWidget from "./AdminDashboardWidget.vue";

const props = defineProps({
  avatarImg: {type: Object, required: false},
  formId: {type: String, required: true}
})
const site = window.location.origin;
const emit = defineEmits(['toast', 'loaded'])

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
                emit('toast', 'Avatar supprimé.', 'success')
              }
            }));
    currentAvatar.value = null
  }
}
</script>

<template>
  <AdminDashboardWidget title="Mon avatar">
    <template #content1>
      <Avatar v-if="currentAvatar" :avatar-img="currentAvatar" @loaded="emit('loaded')"/>
      <div v-else>
        <span class="fs-6 fst-italic text-secondary">
          --- Avatar manquant ---
        </span>
      </div>
    </template>
    <template #buttons1>
      <Button
          :color-class="currentAvatar ? 'warning' : 'primary'"
          :data-bs-target="`#${formId}`"
          :icon-class-start="currentAvatar ? 'pencil-fill' : 'plus-circle-fill'"
          :label="currentAvatar ? 'modifier' : 'ajouter'"
          class="m-2"
          data-bs-toggle="modal"
          round-class="pill"
          type="button"
      />
      <Button
          v-if="currentAvatar"
          class="m-2"
          color-class="danger"
          icon-class-start="trash-fill"
          label="supprimer"
          round-class="pill"
          @click.prevent="deleteMedia"
      />
    </template>
    <template #footer>
      <div class="text-start">
        <HelpBox :instructions="[
      'Acceptés: .jpeg, .png, .webp, .gif',
        'L\'avatar est centré, donc si tu mets un format carré, t\'es tranquille'
    ]" :start-collapsed="true"
        />
      </div>
    </template>
  </AdminDashboardWidget>
</template>