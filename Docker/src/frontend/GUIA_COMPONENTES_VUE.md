# Guía de Componentes en Vue 3

## Índice
1. [Props](#1-props)
2. [Emits](#2-emits)
3. [ref()](#3-ref)
4. [reactive()](#4-reactive)
5. [computed()](#5-computed)
6. [Ciclo de Vida](#6-ciclo-de-vida)
7. [Directivas](#7-directivas)
8. [Composables](#8-composables)
9. [Ejemplos Prácticos](#9-ejemplos-prácticos)
10. [Mejores Prácticas](#10-mejores-prácticas)

---

## 1. Props

Las props permiten pasar datos de un componente padre a un componente hijo.

### Definición de Props

```typescript
<script setup lang="ts">
interface Props {
  title: string
  count?: number
  disabled: boolean
}

const props = withDefaults(defineProps<Props>(), {
  count: 0,
  disabled: false
})
</script>
```

### Uso de Props

```vue
<!-- Componente Padre -->
<template>
  <ChildComponent 
    title="Mi Título" 
    :count="5"
    :disabled="true"
  />
</template>

<!-- Componente Hijo -->
<template>
  <h1>{{ props.title }}</h1>
  <p>Cantidad: {{ props.count }}</p>
  <button :disabled="props.disabled">Click</button>
</template>
```

---

## 2. Emits

Los emits permiten que un componente hijo envíe eventos al componente padre.

### Definición de Emits

```typescript
<script setup lang="ts">
const emit = defineEmits<{
  (e: 'update', value: string): void
  (e: 'close'): void
  (e: 'submit', data: FormData): void
}>()

const handleSubmit = () => {
  emit('submit', formData)
}
</script>
```

### Uso de Emits

```vue
<!-- Componente Hijo -->
<template>
  <button @click="emit('close')">Cerrar</button>
  <button @click="handleSubmit">Enviar</button>
</template>

<!-- Componente Padre -->
<template>
  <ChildComponent 
    @update="handleUpdate"
    @close="handleClose"
    @submit="handleSubmit"
  />
</template>

<script setup lang="ts">
const handleUpdate = (value: string) => {
  console.log('Actualizado:', value)
}
</script>
```

---

## 3. ref()

`ref()` crea una variable reactiva que puede contener cualquier tipo de dato.

```typescript
<script setup lang="ts">
import { ref } from 'vue'

// Variable reactiva simple
const count = ref(0)

// Objeto reactivo
const user = ref({
  name: 'Juan',
  email: 'juan@example.com'
})

// Array reactivo
const items = ref<string[]>([])

// Modificar valores
count.value++
user.value.name = 'Pedro'
items.value.push('nuevo item')
</script>

<template>
  <p>{{ count }}</p>
  <p>{{ user.name }}</p>
  <ul>
    <li v-for="item in items" :key="item">{{ item }}</li>
  </ul>
</template>
```

---

## 4. reactive()

`reactive()` crea un objeto reactivo profundo.

```typescript
<script setup lang="ts">
import { reactive } from 'vue'

const state = reactive({
  count: 0,
  user: {
    name: 'Juan',
    age: 25
  },
  items: [1, 2, 3]
})

// Modificar directamente (no necesita .value)
state.count++
state.user.age = 26
state.items.push(4)
</script>
```

### ref() vs reactive()

| ref() | reactive() |
|-------|------------|
| Funciona con cualquier tipo | Solo objetos |
| Accede con `.value` | Acceso directo |
| Más explícito | Más limpio |
| Preferido para primitivos | Preferido para objetos complejos |

---

## 5. computed()

`computed()` crea propiedades derivadas que se actualizan automáticamente.

```typescript
<script setup lang="ts">
import { ref, computed } from 'vue'

const count = ref(0)
const double = computed(() => count.value * 2)

// Computed con setter
const fullName = computed({
  get: () => firstName.value + ' ' + lastName.value,
  set: (value) => {
    [firstName.value, lastName.value] = value.split(' ')
  }
})
</script>
```

---

## 6. Ciclo de Vida

Los hooks del ciclo de vida permiten ejecutar código en momentos específicos.

```typescript
<script setup lang="ts">
import { 
  onMounted, 
  onUpdated, 
  onUnmounted,
  onBeforeMount,
  onBeforeUpdate,
  onBeforeUnmount
} from 'vue'

// Se ejecuta después de montar el componente
onMounted(() => {
  console.log('Componente montado')
})

// Se ejecuta después de cada actualización
onUpdated(() => {
  console.log('Componente actualizado')
})

// Se ejecuta antes de desmontar
onUnmounted(() => {
  console.log('Componente desmontado')
})
</script>
```

---

## 7. Directivas

### v-if / v-else-if / v-else

```vue
<template>
  <div v-if="type === 'A'">Tipo A</div>
  <div v-else-if="type === 'B'">Tipo B</div>
  <div v-else>Otro tipo</div>
</template>
```

### v-for

```vue
<template>
  <ul>
    <li v-for="(item, index) in items" :key="item.id">
      {{ index }} - {{ item.name }}
    </li>
  </ul>
</template>
```

### v-bind (:attribute)

```vue
<template>
  <img :src="imageUrl" :alt="title" :class="className" />
  <button :disabled="isDisabled">Click</button>
</template>
```

### v-on (@event)

```vue
<template>
  <button @click="handleClick">Click</button>
  <input @input="handleInput" @focus="handleFocus" />
  <form @submit.prevent="handleSubmit">
    <button type="submit">Enviar</button>
  </form>
</template>
```

### v-model

```vue
<template>
  <input v-model="text" />
  <input v-model.number="age" />
  <input v-model.trim="name" />
  <checkbox v-model="isChecked" />
</template>

<script setup lang="ts">
const text = ref('')
const age = ref(0)
const name = ref('')
const isChecked = ref(false)
</script>
```

---

## 8. Composables

Los composables son funciones que encapsulan lógica reutilizable.

### Crear un Composable

```typescript
// composables/useCounter.ts
import { ref } from 'vue'

export function useCounter(initialValue = 0) {
  const count = ref(initialValue)
  
  const increment = () => count.value++
  const decrement = () => count.value--
  const reset = () => count.value = initialValue
  
  return {
    count,
    increment,
    decrement,
    reset
  }
}
```

### Usar un Composable

```vue
<script setup lang="ts">
import { useCounter } from '@/composables/useCounter'

const { count, increment, decrement } = useCounter(10)
</script>

<template>
  <p>{{ count }}</p>
  <button @click="increment">+</button>
  <button @click="decrement">-</button>
</template>
```

---

## 9. Ejemplos Prácticos

### Componente de Formulario

```vue
<script setup lang="ts">
import { ref, reactive, computed } from 'vue'

interface FormData {
  name: string
  email: string
  age: number
}

const form = reactive<FormData>({
  name: '',
  email: '',
  age: 0
})

const errors = ref<string[]>([])
const isSubmitting = ref(false)

const isValid = computed(() => {
  return form.name.length > 0 && 
         form.email.includes('@') && 
         form.age > 0
})

const submit = async () => {
  if (!isValid.value) return
  
  isSubmitting.value = true
  try {
    // Lógica de envío
    emit('submit', form)
  } catch (error) {
    errors.value.push('Error al enviar')
  } finally {
    isSubmitting.value = false
  }
}

const emit = defineEmits<{
  (e: 'submit', data: FormData): void
}>()
</script>

<template>
  <form @submit.prevent="submit">
    <input v-model="form.name" placeholder="Nombre" />
    <input v-model="form.email" placeholder="Email" />
    <input v-model.number="form.age" type="number" />
    
    <div v-if="errors.length" class="errors">
      <p v-for="error in errors" :key="error">{{ error }}</p>
    </div>
    
    <button :disabled="!isValid || isSubmitting">
      {{ isSubmitting ? 'Enviando...' : 'Enviar' }}
    </button>
  </form>
</template>
```

### Componente de Lista con Búsqueda

```vue
<script setup lang="ts">
import { ref, computed } from 'vue'

interface Item {
  id: number
  name: string
  category: string
}

const props = defineProps<{
  items: Item[]
}>()

const emit = defineEmits<{
  (e: 'select', item: Item): void
  (e: 'delete', id: number): void
}>()

const search = ref('')
const selectedCategory = ref('all')

const filteredItems = computed(() => {
  return props.items.filter(item => {
    const matchesSearch = item.name.toLowerCase().includes(search.value.toLowerCase())
    const matchesCategory = selectedCategory.value === 'all' || 
                           item.category === selectedCategory.value
    return matchesSearch && matchesCategory
  })
})

const categories = computed(() => {
  const cats = new Set(props.items.map(item => item.category))
  return ['all', ...Array.from(cats)]
})
</script>

<template>
  <div class="search-container">
    <input v-model="search" placeholder="Buscar..." />
    <select v-model="selectedCategory">
      <option v-for="cat in categories" :key="cat" :value="cat">
        {{ cat }}
      </option>
    </select>
  </div>

  <ul>
    <li v-for="item in filteredItems" :key="item.id">
      <span>{{ item.name }} - {{ item.category }}</span>
      <button @click="emit('select', item)">Seleccionar</button>
      <button @click="emit('delete', item.id)">Eliminar</button>
    </li>
  </ul>
</template>
```

---

## 10. Mejores Prácticas

### 1. Usar TypeScript
```typescript
// ✅ Bien
interface Props {
  title: string
  count?: number
}

// ❌ Evitar
const props = defineProps(['title', 'count'])
```

### 2. Nombres Descriptivos
```typescript
// ✅ Bien
const isLoading = ref(false)
const userData = reactive({ name: '', email: '' })

// ❌ Evitar
const data = ref(false)
const obj = reactive({})
```

### 3. Composables para Lógica Compleja
```typescript
// ✅ Bien
const { data, loading, error } = useFetch('/api/users')

// ❌ Evitar
// Repetir lógica de fetch en cada componente
```

### 4. Validar Props
```typescript
// ✅ Bien
const props = withDefaults(defineProps<Props>(), {
  count: 0,
  disabled: false
})

// ❌ Evitar
// Asumir que las props siempre tienen valor
```

### 5. Limpiar Efectos Secundarios
```typescript
// ✅ Bien
onUnmounted(() => {
  clearInterval(timer)
  subscription.unsubscribe()
})

// ❌ Evitar
// Dejar timers o suscripciones activas
```

### 6. Usar Keys en v-for
```vue
<!-- ✅ Bien -->
<li v-for="item in items" :key="item.id">{{ item.name }}</li>

<!-- ❌ Evitar -->
<li v-for="item in items">{{ item.name }}</li>
```

---

## Recursos Adicionales

- [Documentación Oficial de Vue 3](https://vuejs.org/)
- [Vue TypeScript Guide](https://vuejs.org/guide/typescript/overview.html)
- [Vue Style Guide](https://vuejs.org/about/style-guide.html)
- [Composables](https://vueuse.org/)
