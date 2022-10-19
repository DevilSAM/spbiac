<template>
  <div class="common-layout mt-4">
    <el-container>
      <el-main>

        <el-card shadow="hover" class="box-card mt-5 text-center mx-auto w-50">

          <template #header>
            <div class="card-header">
              <h2 v-if="route.params.id > 0">Изменить породу</h2>
              <h2 v-else>Добавить породу</h2>
            </div>
          </template>

          <el-form :model="form" label-width="150px">
            <el-form-item label="Название">
              <el-input v-model="form.name" />
            </el-form-item>
            <el-form-item label="Описание">
              <el-input v-model="form.description" />
            </el-form-item>
            <el-form-item label="Прод. жизни">
<!--              <el-input v-model="form.long_life" />-->
              <el-input-number v-model="form.long_life" :min="1" :max="10" />
            </el-form-item>

            <el-form-item>
              <el-button type="primary" @click="onSubmit">Сохранить</el-button>
            </el-form-item>

          </el-form>

        </el-card>

      </el-main>
    </el-container>
  </div>
</template>

<script setup>
import InputText from "@/components/Forms/InputText.vue";
import {ref, reactive, onMounted} from "vue";
import {useRoute} from 'vue-router'
import router from "../router";
import axios from "axios";

const route = useRoute()
const breeds = ref([])

onMounted(()=>{
  console.log(route.params.id)
  getBreedData(route.params.id)
})

const form = reactive({
  name: '',
  description: '',
  long_life: 1,
})

const getBreedData = (id) => {
  axios.post('/api/getBreedData', {
    id: id
  })
    .then(res=>{
      if(res.data) {
        form.name = res.data.name
        form.description = res.data.description
        form.long_life = res.data.long_life
      }
    })
}

const onSubmit = (e) => {
  e.preventDefault()
  axios.post('/api/saveBreed', {
    data: form,
    breed_id: route.params?.id
  })
    .then(res=>{
      console.log(res.data)
      if (res.data.success) {
        router.push('/breeds')
      }
    })
}
</script>

<style scoped>
.page-header {
  text-align: center;
}
</style>
