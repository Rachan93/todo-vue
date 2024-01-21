<!-- resources/js/Pages/Tasks/TaskForm.vue -->

<template>
    <div>
      <!-- Task creation form -->
      <form @submit.prevent="createTask">
        <label for="name">Task Name:</label>
        <input type="text" v-model="taskName" id="name" required>
        <button type="submit">Create Task</button>
      </form>
  
      <!-- Task list -->
      <TaskList :tasks="tasks" @setStatus="setStatus" @deleteTask="deleteTask" />
  
      <!-- Delete confirmation modal -->
      <Modal :show="confirmDeleteModal" @close="closeDeleteModal" maxWidth="sm">
        <p>Are you sure you want to delete this task?</p>
        <button @click="deleteConfirmed">Delete</button>
        <button @click="closeDeleteModal">Cancel</button>
      </Modal>
    </div>
  </template>
  
  <script>
  import TaskList from './TaskList.vue';
  import Modal from '../../Components/Modal.vue';
  
  export default {
    components: {
      TaskList,
      Modal,
    },
    data() {
      return {
        taskName: '',
        tasks: [], // Populate tasks data as needed
        confirmDeleteModal: false,
        taskToDelete: null,
      };
    },
    methods: {
      createTask() {
        // Implement your task creation logic
        const newTask = {
          id: Date.now(), // You should generate a unique ID
          name: this.taskName,
          description: '', // Add description as needed
          is_done: false, // Set the initial status
        };
  
        // Emit an event to notify the parent component (index.vue) about the new task
        this.$emit('taskCreated', newTask);
  
        // Clear the form after creation
        this.taskName = '';
      },
      setStatus(task) {
        // Implement your task status update logic
        console.log('Set status for task:', task);
      },
      deleteTask(task) {
        // Show delete confirmation modal
        this.taskToDelete = task;
        this.confirmDeleteModal = true;
      },
      deleteConfirmed() {
        // Implement your task deletion logic
        console.log('Task deleted:', this.taskToDelete);
        // Close the delete confirmation modal
        this.confirmDeleteModal = false;
        this.taskToDelete = null;
      },
      closeDeleteModal() {
        // Close the delete confirmation modal without deleting
        this.confirmDeleteModal = false;
        this.taskToDelete = null;
      },
    },
  };
  </script>
  