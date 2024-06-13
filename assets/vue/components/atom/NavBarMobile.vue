<script setup>
import {computed, onBeforeMount, onMounted, ref, watch} from "vue";
import NavItemMobile from "./NavItemMobile.vue";
import {goTo} from "../../composable/action/redirect";
import SocialItem from "./SocialItem.vue";

const props = defineProps({
  navigation: {type: Object, required: true},
  screenWidth: {type: [String, Number], required: false},
  socialItems: {type: Object, required: true}
})

const currentAnchor = ref('');
const navItemPositions = ref([])
const currentNavItemPosition = computed(() => {
  return navItemPositions.value[currentAnchor.value.replace('#', '')] + 'px'
})
const thisScreenWidth = computed(() => {
  return props.screenWidth
})

watch(thisScreenWidth, () => {
  handleNavItemPositions()
})

const handleNavItemPositions = () => {
  for (const key in props.navigation) {
    const el = document.getElementById(`mb-nav-${props.navigation[key].label}`)
    navItemPositions.value[key] = el.offsetLeft + el.offsetWidth / 2
  }
}

onMounted(() => {
  currentAnchor.value = window.location.hash
  handleNavItemPositions()
})

const navigate = (link) => {
  const site = window.location.origin;

  if (link.includes('#')) {
    window.location.hash = link
    currentAnchor.value = window.location.hash
  } else {
    goTo(`${site}${link}`)
  }
}

</script>

<template>
  <nav class="fixed-bottom nav-parent-container">
    <div :style="currentAnchor !== '' ?
    `transform: translate(calc(-50% + ${currentNavItemPosition}), -100%);` : 'opacity: 0 !important;'"
         class="bg-info rounded-circle big-ball"></div>

    <div :style="currentAnchor !== '' ?
    `transform: translate(calc(-50% + ${currentNavItemPosition}), -125%);` : 'opacity: 0 !important;'"
         class="bg-light ball rounded-circle"></div>

    <div :class="currentAnchor !== '' ? 'mb-nav-container-locator' : ''"
         class="d-flex justify-content-evenly align-items-center bg-info mx-auto mb-nav-container"
    >
      <div v-for="link in navigation">
        <NavItemMobile
            :id="`mb-nav-${link.label}`"
            :class="currentAnchor === link.link ? 'nav-active text-info' : 'nav-idle text-light'"
            :icon-size="currentAnchor === link.link ? '20' : '30'"
            :is-current-location="link.link === currentAnchor"
            :link="link"
            @navigate="navigate"
        />
      </div>
    </div>
  </nav>
  <div
      class="fixed-top d-flex justify-content-center align-items-center nav-parent-container-top bg-info w-100 rounded-bottom-5">
    <ul class="list-unstyled justify-content-end d-flex align-items-center m-0">
      <li v-for="socialItem in socialItems" class="mx-1">
        <SocialItem :social-item="socialItem" size="40"/>
      </li>
    </ul>
  </div>
  <div class="py-5"></div>
</template>

<style lang="scss" scoped>
@import '../../../styles/animation';
@import '../../../styles/var-override';

$currentBallPosition: v-bind(currentNavItemPosition);
$ballWidth: 20px;
$transition: all $duration $timing;

.nav-active {
  transition: $transition;
  transform: translateY(-145%);
}

.nav-idle {
  transition: $transition;
  transform: translateY(0);
}

.ball {
  width: $ballWidth * 2;
  aspect-ratio: 1/1;
  transition: $transition;
  position: absolute;
  left: 0;
  top: 0;
  z-index: 0;
}

.big-ball {
  width: $ballWidth * 3;
  aspect-ratio: 1/1;
  transition: $transition;
  position: absolute;
  left: 0;
  top: 0;
}

.nav-parent-container-top {
  animation-name: slideInDown;
  animation-delay: 0s;
  animation-duration: $duration * 2;
  animation-timing-function: $timing;
  height: 75px;
}

.nav-parent-container {
  animation-name: slideInUp;
  animation-delay: 0s;
  animation-duration: $duration * 2;
  animation-timing-function: $timing;
}

.mb-nav-container {
  width: 100%;
  height: 75px;
}

@keyframes slideInUp {
  0% {
    transform: translateY(200%);
  }
  5% {
    transform: translateY(200%);
  }
  100% {
    transform: translateY(0%);
  }
}

@keyframes slideInDown {
  0% {
    transform: translateY(-100%);
  }
  5% {
    transform: translateY(-100%);
  }
  100% {
    transform: translateY(0%);
  }
}

.mb-nav-container-locator {

  &:before, &:after {
    transition: $transition;
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    width: $ballWidth * 3;
    aspect-ratio: 1/1;
    border-radius: $ballWidth * 3;
    background-color: transparent;
    z-index: -2;
  }

  &:before {
    transform: translate(calc(-50% + $currentBallPosition - $ballWidth * 3), calc(-50% - $ballWidth * 1.5));
    box-shadow: calc($ballWidth * 3 / 2) calc($ballWidth * 3 / 2) 0 0 $info;
  }

  &:after {
    transform: translate(calc(-50% + $currentBallPosition + $ballWidth * 3), calc(-50% - $ballWidth * 1.5));
    box-shadow: calc($ballWidth * -3 / 2) calc($ballWidth * 3 / 2) 0 0 $info;
  }
}

</style>