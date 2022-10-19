<template>
  <div class="container">
    <navbar-component></navbar-component>
    <router-view></router-view>

  </div>
</template>

<script lang="ts">
import NavbarComponent from '@/components/NavbarComponent.vue';
import {defineComponent} from 'vue';

export default defineComponent({
  components: {NavbarComponent},
  name: "App"
});
</script>
