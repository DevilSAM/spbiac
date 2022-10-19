<template>

  <h1 class="mt-5 text-center">Cat's App</h1>

  <el-row :gutter="20">

    <el-col :span="8" :offset="2">
      <router-link to="/cats">
        <el-card shadow="hover" class="box-card mt-5 text-center mx-auto">
          <el-image src="assets/images/cat.webp" :fit="`cover`" />
          <h3>Кошки</h3>
        </el-card>
      </router-link>
    </el-col>

    <el-col :span="8" :offset="4">
      <router-link to="/breeds">
        <el-card shadow="hover" class="box-card mt-5 text-center mx-auto">
          <el-image src="assets/images/cats_breed.webp" :fit="`cover`" />
          <h3>Породы кошек</h3>
        </el-card>
      </router-link>
    </el-col>

  </el-row>





</template>

<script lang="ts">
export default {
  name: "HomePage",
  data() {
    return {}
  },
}
</script>
