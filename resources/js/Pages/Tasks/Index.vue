<template>
    <div>
      <h1>Tasks Index Page</h1>
  
      <!-- Include TaskForm component to create tasks -->
      <TaskForm @taskCreated="updateTasks" />
  
      <!-- Include TaskList component to display tasks -->
      <TaskList :tasks="tasks" />
    </div>
  </template>
  
  <script>
  import TaskList from './TaskList.vue';
  import TaskForm from './TaskForm.vue';  // Import the TaskForm component
  
  export default {
    components: {
      TaskList,
      TaskForm,
    },
    props: {
      tasks: Array,
    },
    methods: {
      // Method to update tasks after creation
      updateTasks(task) {
        this.tasks.push(task);
      },
    },
  };
  </script>
  