<script setup>
import Button from "../../controllers/components/Button.vue";
import {Modal} from 'bootstrap';
import {onMounted, ref} from "vue";
import HelpBox from "../atom/HelpBox.vue";
import MediaThumbnail from "../atom/MediaThumbnail.vue";

const props = defineProps({
  meufImg: {type: Object, required: false},
  formId: {type: String, required: true}
})
const site = window.location.origin;

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
                console.log(obj.body.message);
              }
            }));
    currentMeufImg.value = null
  }
}
</script>

<template>
  <div class="bg-white shadow rounded-5 position-relative pt-5 p-3 text-center">
    <div>
      <p class="fs-4 fw-bold text-info m-0 position-absolute top-0 start-0 ms-3 mt-3">Mon meuf</p>
      <div class="position-absolute top-0 end-0 me-3 mt-3 d-flex flex-column">
        <Button
            :color-class="currentMeufImg ? 'warning' : 'primary'"
            :data-bs-target="`#${formId}`"
            :icon-class-start="currentMeufImg ? 'pencil-fill' : 'plus-circle-fill'"
            :label="currentMeufImg ? 'modifier' : 'ajouter'"
            data-bs-toggle="modal"
            round-class="pill"
            type="button"
        />
        <Button
            v-if="currentMeufImg"
            color-class="danger"
            icon-class-start="trash-fill"
            label="supprimer"
            round-class="pill"
            @click.prevent="deleteMedia"
        />
      </div>
    </div>
    <MediaThumbnail v-if="meufImg" :media="meufImg" :square="false" class="w-75 mt-5"/>
    <div class="text-start">
      <HelpBox :instructions="[
      'Acceptés: .jpeg, .png, .webp, .gif',
        'L\'meuf est centré, donc si tu mets un format carré, t\'es tranquille'
    ]" :start-collapsed="true" class="mt-4"
      />
    </div>
  </div>
</template>

<style scoped>

</style>