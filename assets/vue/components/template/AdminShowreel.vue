<script setup>
import Button from "../../controllers/components/Button.vue";
import {onMounted, ref} from "vue";
import HelpBox from "../atom/HelpBox.vue";
import MediaThumbnail from "../atom/MediaThumbnail.vue";
import AdminDashboardWidget from "./AdminDashboardWidget.vue";

const props = defineProps({
  showreelImg: {type: Object, required: false},
  showreelThumbnailformId: {type: String, required: true},
  showreelVideoFormId: {type: String, required: true},
  showreelVideoId: {type: Object, required: true}
})
const site = window.location.origin;
const emit = defineEmits(['toast'])
const currentShowreelImg = ref();

onMounted(() => {
  currentShowreelImg.value = props.showreelImg
})


const deleteMedia = async () => {
  if (confirm('Sure de vouloir supprimer ' + props.showreelImg.mediaPath + ' ?')) {
    await fetch(`${site}/media/${props.showreelImg.id}/delete`)
        .then(r => r.json().then(data => ({ok: r.ok, body: data}))
            .then(obj => {
              if (obj.ok) {
                emit('toast', 'Vignette de showreel supprimée.', 'success')
                currentShowreelImg.value = null
              }
            }));
  }
}
</script>

<template>
  <AdminDashboardWidget title="Mon showreel">
    <template #content1>
      <MediaThumbnail v-if="currentShowreelImg" :media="currentShowreelImg" :square="false"/>
      <div v-else>
        <span class="fs-6 fst-italic text-secondary">
          --- Vignette manquante ---
        </span>
      </div>
    </template>
    <template #buttons1>
      <Button
          :color-class="currentShowreelImg ? 'warning' : 'primary'"
          :data-bs-target="`#${showreelThumbnailformId}`"
          :icon-class-start="currentShowreelImg ? 'pencil-fill' : 'plus-circle-fill'"
          :label="currentShowreelImg ? 'modifier' : 'ajouter'"
          class="m-2"
          data-bs-toggle="modal"
          round-class="pill"
          type="button"
      />
      <Button
          v-if="currentShowreelImg"
          class="m-2"
          color-class="danger"
          icon-class-start="trash-fill"
          label="supprimer"
          round-class="pill"
          @click.prevent="deleteMedia"
      />
    </template>
    <template #content2>
      <a
          v-if="showreelVideoId"
          :href="`https://www.vimeo.com/${showreelVideoId.mediaPath}`"
          class="btn btn-info rounded-pill"
          role="button"
          target="_blank"
      >
        Showreel actuel
        <i class="bi bi-arrow-up-right-circle-fill px-2"></i>
      </a>
      <div v-else>
        <span class="fs-6 fst-italic text-secondary">
          --- Video manquante ---
        </span>
      </div>

    </template>
    <template #buttons2>
      <Button
          :color-class="showreelVideoId ? 'warning' : 'primary'"
          :data-bs-target="`#${showreelVideoFormId}`"
          :icon-class-start="showreelVideoId ? 'pencil-fill' : 'plus-circle-fill'"
          :label="showreelVideoId ? 'modifier' : 'ajouter'"
          class="m-2"
          data-bs-toggle="modal"
          round-class="pill"
          type="button"
      />
    </template>
    <template #footer>
      <div class="text-start">
        <HelpBox :instructions="[
      'Extension de vignette acceptés: .jpeg, .png, .webp, .gif',
      'Pour la video: il faut uniquement l\'id de la vidéo',
      'Exemple: https://www.vimeo.com/[ -> id <- ] - clique sur le bouton, y a une image'
    ]" :start-collapsed="true"
        />
      </div>
    </template>
  </AdminDashboardWidget>
</template>