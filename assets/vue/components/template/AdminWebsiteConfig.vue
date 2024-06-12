<script setup>
import Button from "../../controllers/components/Button.vue";
import {Modal} from 'bootstrap';
import {computed, onMounted, ref} from "vue";
import HelpBox from "../atom/HelpBox.vue";
import MediaThumbnail from "../atom/MediaThumbnail.vue";
import AdminDashboardWidget from "./AdminDashboardWidget.vue";
import {truncate} from "../../composable/formatter/string";

const props = defineProps({
  websiteConfig: {type: Object, required: false},
  websiteConfigFormId: {type: String, required: true},
  favicon: {type: Object, required: false},
  isDefaultWebsiteConfig: {type: Object, required: true}
})

const isAtLeastOneDefault = computed(() => {
  const vote = [];

  for (const key in props.isDefaultWebsiteConfig) {
    vote.push(props.isDefaultWebsiteConfig[key])
  }

  return vote.includes(true)
})


</script>

<template>
  <AdminDashboardWidget :cols="[9, 3]" :columns="false" title="Les metadatas / partage réseaux">
    <template #content1>
      <div>
        <div class="text-start p-2 border border-1 border-info-subtle rounded-4 my-3">
          <span class="ps-4 fw-bold">CheckList</span>
          <ul v-if="isAtLeastOneDefault || !favicon" class="list-group list-group-flush">
            <li class="list-group-item">
              Favicon
              <span v-if="!favicon">
                   manquant <i class="bi bi-x-circle-fill text-danger"></i>
                </span>
              <span v-else>
                 ajouté <i class="bi bi-check-circle-fill text-success"></i>
              </span>
            </li>

            <li class="list-group-item">
              Image
              <span v-if="isDefaultWebsiteConfig.seoImg">
                 par défaut <i class="bi bi-x-circle-fill text-warning"></i>
              </span>
              <span v-else>
                 ajoutée <i class="bi bi-check-circle-fill text-success"></i>
              </span>
            </li>

            <li class="list-group-item">
              Titre
              <span v-if="isDefaultWebsiteConfig.title">
                 par défaut <i class="bi bi-x-circle-fill text-warning"></i>
              </span>
              <span v-else>
                 ajouté <i class="bi bi-check-circle-fill text-success"></i>
              </span>
            </li>

            <li class="list-group-item">
              Description
              <span v-if="isDefaultWebsiteConfig.description">
                 par défaut <i class="bi bi-x-circle-fill text-warning"></i>
              </span>
              <span v-else>
                 ajoutée <i class="bi bi-check-circle-fill text-success"></i>
              </span>
            </li>
          </ul>
          <span v-else> - All good <i class="bi bi-check-circle-fill text-success"></i></span>
        </div>
        <div class="my-3">
          <span>Ca devrait ressembler a peu près a ça :)</span>
        </div>
        <div class="card">
          <div class="card-header d-flex justify-content-start align-items-center">
            <img v-if="favicon" :src="'/build/media/' + favicon.mediaPath"
                 alt="Augusta Sarlin favicon - motion designer"
                 class="me-3" style="width: 30px !important; height: auto !important;">
            <span class="text-start">{{ websiteConfig.title }}</span>
          </div>
          <div class="card-body p-0">
            <img
                v-if="websiteConfig.image"
                :src="'/build/media/' + websiteConfig.image"
                :style="`max-width: ${websiteConfig.ogImageWidth}px !important; max-height: ${websiteConfig.ogImageHeight}px !important; aspect-ratio: 1.91/1 !important;`"
                alt="Augusta Sarlin - image de partage - motion designer lyon"
                class="card-img object-fit-cover"
            >
            <span v-else>--- Aucune Image ---</span>
          </div>
          <div class="card-footer text-start">
            <span class="text-nowrap opacity-50">{{ websiteConfig.canonical }}</span>
            <div class="card-title">
              <span class="fw-bolder">{{ websiteConfig.title }}</span>
            </div>
            <span>{{ truncate(websiteConfig.description, 100, '...') }}</span>
          </div>
        </div>
      </div>
    </template>
    <template #buttons1>
      <Button
          :color-class="websiteConfig ? 'warning' : 'primary'"
          :data-bs-target="`#${websiteConfigFormId}`"
          :icon-class-start="websiteConfig ? 'pencil-fill' : 'plus-circle-fill'"
          :label="websiteConfig ? 'modifier' : 'ajouter'"
          class="m-2"
          data-bs-toggle="modal"
          round-class="pill"
          type="button"
      />
    </template>
    <template #footer>
      <div class="text-start">
        <HelpBox :instructions="[
      'Acceptés: .jpeg, .png',
        `Taille max de l\'image: ${websiteConfig.ogImageWidth}px / ${websiteConfig.ogImageHeight}px`,
        'Taille conseillé pour le favicon: 30px / 30px',
        'Pour le référencement, pense aux mots clés \'motion, designer, augusta, sarlin, lyon\' ... etc',
        'Si tu n\'ajoute rien, il y a des valeurs par defaut'
    ]" :start-collapsed="true"
        />
      </div>
    </template>
  </AdminDashboardWidget>
</template>