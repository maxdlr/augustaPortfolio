<script setup>
import {computed, onMounted, onUnmounted, onUpdated, ref} from "vue";
import NavItemMobile from "./NavItemMobile.vue";

const props = defineProps({
  navigation: {type: Object, required: true}
})

const currentAnchor = ref('');
const navItemPositions = ref([])

onMounted(() => {
  currentAnchor.value = window.location.hash

  for (const key in props.navigation) {
    const el = document.getElementById(`mb-nav-${props.navigation[key].label}`)
    navItemPositions.value[key] = el.offsetLeft + el.offsetWidth / 2
  }
  console.log(currentAnchor.value)
  console.log(navItemPositions.value)
})

const navigate = (link) => {
  window.location.hash = link
  currentAnchor.value = window.location.hash
}

</script>

<template>
  <nav class="fixed-bottom">
    <div :style="`transform: translateX(calc(-50% + ${navItemPositions[currentAnchor.replace('#', '')]}px));`"
         class="bg-primary ball rounded-circle"></div>
    <div
        class="d-flex justify-content-evenly align-items-center bg-info mx-auto mb-nav-container">
      <div v-for="link in navigation">
        <NavItemMobile
            :id="`mb-nav-${link.label}`"
            :is-current-location="link.link === currentAnchor"
            :link="link"
            @navigate="navigate"
        />
      </div>
    </div>
  </nav>
</template>

<style lang="scss" scoped>
@import '../../../styles/animation';

.ball {
  width: 20px;
  aspect-ratio: 1/1;
  transition: transform $duration $timing;
}

.mb-nav-container {
  max-width: 75vw;
  height: 100px;
  border-radius: 50px 50px 0 0;
}

</style>