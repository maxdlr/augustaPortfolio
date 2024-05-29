<script setup>
import {toTitle} from "../../composable/formatter/string";
import {onBeforeMount, onMounted, ref, watch} from "vue";
import {SLIDE_LEFT, SLIDE_RIGHT, SLIDE_UP} from "../../constant/animation";

const props = defineProps({
  item: {type: Object, required: true}
})

const hovering = ref();
const rand = ref();
const minRand = ref();
const randNumber = () => {
  return Math.round(Math.random() * 50)
};

const getRand = () => {
  const randValue = randNumber();
  rand.value = randValue + 'px';
  minRand.value = -randValue + 'px';
}

onBeforeMount(() => {
  getRand();
})
const reRenderKey = ref(0);

const reRender = () => {
  reRenderKey.value++
  getRand()
}
</script>

<template>
  <div class="position-relative"
       @mouseenter="hovering = true"
       @mouseleave="hovering = false"
  >
    <div class="p-2 pt-3 px-4 rounded-5">
      <a
          :href="item.link"
          class="link-underline link-underline-opacity-0"
      >
        <h6 class="fs-6 m-0 text-nowrap">
          <span class="fs-title">{{ toTitle(item.title) + ' ' }}</span>
          <span>@{{ item.labelLink }}</span>
        </h6>
        <div>
          <span class="ps-2 d-inline-block text-truncate" style="max-width: 350px;">{{ item.description }}</span>
        </div>
      </a>
    </div>
  </div>
</template>

<style lang="scss" scoped>

</style>