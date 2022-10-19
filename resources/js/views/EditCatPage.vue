<template>
  <div class="common-layout mt-4">
    <el-container>
      <el-main>

        <el-card shadow="hover" class="box-card mt-5 text-center mx-auto w-50">

          <template #header>
            <div class="card-header">
              <h2 v-if="route.params.id > 0">Редактировать котейку</h2>
              <h2 v-else>Добавить котейку</h2>
            </div>
          </template>

          <el-form
            :model="form"
            ref="formRef"
            :rules="rules"
            label-width="120px"
          >
            <el-form-item label="Имя" prop="name">
              <el-input v-model="form.name" />
            </el-form-item>

            <el-form-item label="Порода" prop="breed_id">
              <el-select v-model="form.breed_id" placeholder="Выбрать породу кошки" class="w-100">
                <el-option :label="breed.name" :value="breed.id" v-model="form.breed_id" v-for="breed in breeds" />
              </el-select>
            </el-form-item>

            <el-form-item label="Возраст" prop="age">
              <el-input-number v-model="form.age" :min="1" :max="100" />
            </el-form-item>

            <el-form-item label="Фото" prop="image">
              <el-image :src="`${form.image}`" :fit="`cover`" class="cat-photo me-3" v-if="form.image"/>
              <span v-else class="me-3">Нажми, чтобы обновить фото -> </span>
              <Refresh style="width: 2rem; height: 2rem; margin-right: 8px" class="hover-pointed" @click="refreshPhoto" v-if="!loading" />
            </el-form-item>

            <el-form-item>
              <el-button type="primary" @click="onSubmit(formRef)" :disabled="!savingAllowed">Сохранить</el-button>
            </el-form-item>

          </el-form>

        </el-card>

      </el-main>
    </el-container>
  </div>
</template>

<script setup lang="ts">
import {ref, reactive, computed, onMounted} from "vue";
import {useRoute} from 'vue-router'
import router from "../router";
import axios from "axios";
import {FormInstance, FormRules} from "element-plus";

const route = useRoute()
const breeds = ref([])
let loading = ref(false)
const formRef = ref<FormInstance>()


// правила для валидации формы
const rules = reactive<FormRules>({
  name: [
    {required: true, message: 'Введите название породы', trigger: 'blur'},
  ],
  breed_id: [
    {required: true, message: 'Выберите из выпадающего меню', trigger: 'blur'},
  ],
  image: [
    {required: true, message: 'Нажмите на иконку "refresh", чтобы получить фото', trigger: 'blur'},
  ],
})

// действия при загрузке компонента
onMounted(()=>{
  getCatData(route.params.id)
})

const form = reactive({
  name: '',
  image: '',
  age: 1,
  breed_id: '',
})

const savingAllowed = computed(()=>{
  return form.name && form.image && form.age && form.breed_id || true
})

const getCatData = (id: any) => {
  axios.post('/api/getCatData', {
    id: id
  })
  .then((res: any)=>{
    // если редирект
    if(res.data.redirect) {
      alert('Ошибка! Котейка не найден.')
      router.push('/cats')
    }

    breeds.value = res.data.breeds

    if(res.data?.cat) {
      form.name = res.data?.cat?.name
      form.image = res.data?.cat?.image
      form.age = res.data?.cat?.age
      form.breed_id = res.data?.cat?.breed_id
    }
  })
}

// отправка данных на сервер для сохранения изменений
const onSubmit = async (formEl: FormInstance | undefined) => {
  if (!formEl) return
  await formEl.validate((valid: any, fields: any) => {
    if (valid) {
      axios.post('/api/saveCat', {
        data: form,
        cat_id: route.params?.id
      })
        .then((res: any)=>{
          if (res.data.success) {
            router.push('/cats')
          }
        })

    } else {
      console.log('error submit!', fields)
    }
  })
}

// обновляем фотографию котика (запрос на сторонний сервер делаем с нашего бэка)
const refreshPhoto = () => {
  loading.value = true
  axios.post('/api/refreshPhoto')
  .then((res: any)=>{
    form.image = res.data[0].url
    console.log(res.data[0].url)
  })
  .finally(()=>{
    loading.value = false
  })
}
</script>

<style scoped>
.page-header {
  text-align: center;
}
.cat-photo {
  width: 200px;
  border-radius: 10px;
}
.update-photo-btn {
  margin-left: 1rem;
  align-self: baseline;
}
</style>
