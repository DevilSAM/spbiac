<template>
  <div class="common-layout container">
    <el-container class="vh-100">
      <el-header class="px-0">
        <navbar-component></navbar-component>
      </el-header>
      <el-main>
        <router-view></router-view>
      </el-main>
      <el-footer class="px-0">
        <footer-component></footer-component>
      </el-footer>
    </el-container>
  </div>
</template>

<script lang="ts">
import NavbarComponent from '@/components/NavbarComponent.vue';
import FooterComponent from '@/components/FooterComponent.vue';
import {defineComponent} from 'vue';

export default defineComponent({
  components: {NavbarComponent, FooterComponent},
  name: "App"
});
</script>

<style scoped>
.vh-100 {
  min-height: 100vh;
}
.container {
  height: 100vh;
  background: linear-gradient(to bottom, #ffffff 0%, #e5ece4 50%, #ffffff 100%);
  padding-left: 0;
  padding-right: 0;
}
</style>
