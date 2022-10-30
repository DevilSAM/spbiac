<template>
  <div class="common-layout mt-4">
    <el-container>
      <el-main>

        <el-card shadow="hover" class="box-card mt-5 text-center mx-auto w-50">

          <template #header>
            <div class="card-header">
              <h2 v-if="route.params.id > 0">Change the Breed</h2>
              <h2 v-else>Add a Breed</h2>
            </div>
          </template>

          <el-form
            ref="formRef"
            :model="form"
            :rules="rules"
            label-width="120px"
            status-icon
          >
            <el-form-item label="Name" prop="name">
              <el-input v-model="form.name" />
            </el-form-item>

            <el-form-item label="Description" prop="description">
              <el-input v-model="form.description" />
            </el-form-item>

            <el-form-item label="Long Life" prop="long_life">
              <el-input-number v-model="form.long_life" :min="1" :max="100" />
            </el-form-item>

            <el-form-item>
              <el-button type="primary" @click="onSubmit(formRef)" :disabled="!savingAllowed">Save</el-button>
            </el-form-item>

          </el-form>

        </el-card>

      </el-main>
    </el-container>
  </div>
</template>

<script setup lang="ts">
import type { FormInstance, FormRules } from 'element-plus'
import {ref, reactive, onMounted, computed} from "vue";
import {useRoute} from 'vue-router'
import router from "../router";
import axios from "axios";

const route = useRoute()
const breeds = ref([])
const formRef = ref<FormInstance>()

// правила для валидации формы
const rules = reactive<FormRules>({
  name: [
    {required: true, message: 'Enter a breed\'s name', trigger: 'blur'},
  ],
  description: [
    {required: true, message: 'Enter a description', trigger: 'blur'},
    { min: 10, message: '10 symbols min', trigger: 'blur' },
  ],
})

// дейсвтия при подключении компонента
onMounted(()=>{
  console.log(route.params.id)
  getBreedData(route.params.id)
})

// чтобы задизейблить кнопку сохранения
const savingAllowed = computed(()=>{
  return form.name && form.description && form.long_life
})

// данные формы
const form = reactive({
  name: '',
  description: '',
  long_life: 1,
})

// получение данных о доступных породах кошек
const getBreedData = (id: any) => {
  axios.post('/api/getBreedData', {
    id: id
  })
    .then((res: any) =>{
      if(res.data) {
        form.name = res.data.name
        form.description = res.data.description
        form.long_life = res.data.long_life
      }
    })
}

// отправка данных на сервер для сохранения изменений
const onSubmit = async (formEl: FormInstance | undefined) => {
  if (!formEl) return
  await formEl.validate((valid: any, fields: any) => {
    if (valid) {
      axios.post('/api/saveBreed', {
        data: form,
        breed_id: route.params?.id
      })
        .then((res: any) =>{
          if (res.data.success) {
            router.push('/breeds')
          }
        })

    } else {
      console.log('error submit!', fields)
    }
  })
}
</script>

<style scoped>
.page-header {
  text-align: center;
}
</style>
