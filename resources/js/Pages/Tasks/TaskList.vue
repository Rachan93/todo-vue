<template>
    <div>
        <h1>Task List</h1>
        <ul>
            <li v-for="task in tasks" :key="getTaskId(task)">
                <template v-if="task">
                    <strong>{{ task.name }}</strong>
                    <p>{{ task.description }}</p>
                    <span v-if="task.is_done">Completed</span>
                    <span v-else>Not Completed</span>
                </template>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        tasks: Array,
    },
    methods: {
        getTaskId(task) {
            // Ensure that the task is defined and has an 'id' property
            return task && task.id !== undefined ? task.id : null;
        },
    },
};
</script>
