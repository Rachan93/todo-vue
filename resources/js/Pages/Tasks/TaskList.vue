<!-- resources/js/Pages/Tasks/TaskList.vue -->

<template>
  <div>
    <h1>Task List</h1>
    <ul>
      <li v-for="task in tasks" :key="task.id">
        <strong>{{ task.name }}</strong>
        <p>{{ task.description }}</p>
        <span v-if="task.is_done">Completed</span>
        <span v-else>Not Completed</span>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    tasks: Array,
  },
};
</script>
