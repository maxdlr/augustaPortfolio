<script setup>
import Button from "../../controllers/components/Button.vue";
import {Modal} from 'bootstrap';
import {onMounted, ref} from "vue";
import HelpBox from "../atom/HelpBox.vue";
import MediaThumbnail from "../atom/MediaThumbnail.vue";
import AdminDashboardWidget from "./AdminDashboardWidget.vue";

const props = defineProps({
  meufImg: {type: Object, required: false},
  formId: {type: String, required: true}
})
const site = window.location.origin;
const emit = defineEmits(['toast'])
const currentMeufImg = ref();

onMounted(() => {
  currentMeufImg.value = props.meufImg
})

const deleteMedia = async () => {
  if (confirm('Sure de vouloir supprimer ' + props.meufImg.mediaPath + ' ?')) {
    await fetch(`${site}/media/${props.meufImg.id}/delete`)
        .then(r => r.json().then(data => ({ok: r.ok, body: data}))
            .then(obj => {
              if (obj.ok) {
                emit('toast', 'Meuf supprimée.', 'success')
              }
            }));
    currentMeufImg.value = null
  }
}
</script>

<template>
  <AdminDashboardWidget title="La meuf">
    <template #content1>
      <MediaThumbnail v-if="currentMeufImg" :media="currentMeufImg" :square="false" class="w-75 mt-5"/>
      <div v-else>
        <span class="fs-6 fst-italic text-secondary">
          --- Meuf manquante ---
        </span>
      </div>
    </template>
    <template #buttons1>
      <Button
          :color-class="currentMeufImg ? 'warning' : 'primary'"
          :data-bs-target="`#${formId}`"
          :icon-class-start="currentMeufImg ? 'pencil-fill' : 'plus-circle-fill'"
          :label="currentMeufImg ? 'modifier' : 'ajouter'"
          class="m-2"
          data-bs-toggle="modal"
          round-class="pill"
          type="button"
      />
      <Button
          v-if="currentMeufImg"
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
        'Fait gaffe que ce soit pas trop lourd - 50mo max'
    ]" :start-collapsed="true"
        />
      </div>
    </template>
  </AdminDashboardWidget>
</template>