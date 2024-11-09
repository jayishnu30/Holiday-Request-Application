<template>
  <div class="holiday-table">
    <div class="search-section">
      <input type="text" placeholder="Search for name" v-model="nameSearch" />
      <input type="text" placeholder="Search for Department" v-model="departmentSearch" />
      <button @click="search">Search</button>
    </div>

    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Surname</th>
          <th>Department</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="employee in filteredEmployees" :key="employee.id">
          <td>{{ employee.name }}</td>
          <td>{{ employee.surname }}</td>
          <td>{{ employee.department }}</td>
          <td>
            <button @click="toggleHoliday(employee.id)">
              <img src="https://img.icons8.com/ios-filled/20/000000/visible.png" />
            </button>
            <div v-if="showHolidayDetails[employee.id]" class="holiday-details">
              <ul>
                <li>From 01/02 to 13/02</li>
                <li>From 19/02 to 21/02</li>
                <li>From 03/04 to 08/04</li>
              </ul>
              <button @click="closeHoliday(employee.id)">Close</button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: "HolidayTable",
  data() {
    return {
      nameSearch: "",
      departmentSearch: "",
      employees: [
        { id: 1, name: "Erik", surname: "Smith", department: "Accounting" },
        { id: 2, name: "Paul", surname: "Cox", department: "Accounting" },
        { id: 3, name: "William", surname: "Terry", department: "Product Analysis" },
        { id: 4, name: "Mark", surname: "Spencer", department: "Business & Services" },
        { id: 5, name: "Erik", surname: "Smith", department: "Software Development" },
      ],
      showHolidayDetails: {}
    };
  },
  computed: {
    filteredEmployees() {
      return this.employees.filter((employee) =>
        employee.name.toLowerCase().includes(this.nameSearch.toLowerCase()) &&
        employee.department.toLowerCase().includes(this.departmentSearch.toLowerCase())
      );
    }
  },
  methods: {
    search() {
      // Placeholder search logic if needed
    },
    toggleHoliday(employeeId) {
      this.$set(this.showHolidayDetails, employeeId, !this.showHolidayDetails[employeeId]);
    },
    closeHoliday(employeeId) {
      this.$set(this.showHolidayDetails, employeeId, false);
    }
  }
};
</script>

<style scoped>
.holiday-table {
  background-color: #f8f8f8;
  padding: 20px;
}

.search-section {
  display: flex;
  gap: 10px;
  margin-bottom: 20px;
}

table {
  width: 100%;
  border-collapse: collapse;
}

th {
  background-color: #2196F3;
  color: white;
  padding: 10px;
}

td {
  padding: 10px;
  border: 1px solid #ddd;
  text-align: left;
}

button {
  background-color: #2196F3;
  border: none;
  color: white;
  padding: 5px;
  cursor: pointer;
  border-radius: 50%;
}

.holiday-details {
  position: absolute;
  margin-top: 10px;
  padding: 10px;
  background-color: #fff;
  border: 1px solid #ddd;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  z-index: 10;
}
</style>
