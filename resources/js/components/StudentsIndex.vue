<template>
    <div>
        <div class="d-flex justify-content-between align-content-center mb-2">
            <div class="d-flex">
                <div>
                    <paginate-select
                        v-model="paginate"
                        label="Per Page"
                    >
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                    </paginate-select>
                </div>
                <div>
                    <div class="d-flex align-items-center ml-4">
                        <label for="paginate" class="text-nowrap mr-2 mb-0">FilterBy Class</label>
                        <select 
                            v-model="selectedClass"
                            class="form-control form-control-sm"
                        >
                            <option value="">All Class</option>
                            <option
                                v-for="item in classes"
                                :key="item.id"
                                :value="item.id"
                            >
                                {{ item.name }}
                            </option>
                        </select>
                    </div>
                </div>

                <div v-if="selectedClass">
                    <div class="d-flex align-items-center ml-4">
                        <label for="paginate" class="text-nowrap mr-2 mb-0">Section</label>
                        <select
                            v-model="selectedSection"
                            class="form-control form-control-sm"
                        >
                            <option value="">Select a Section</option>
                            <option 
                                v-for="section in sections"
                                :key="section.id"
                                :value="section.id"
                            >
                                {{ section.name }}
                            </option>
                        </select>
                    </div>
                </div>

                <div>
                    <div class="dropdown ml-4">
                        <button
                            v-if="checked.length > 0"
                            class="btn btn-secondary dropdown-toggle"
                            data-toggle="dropdown"
                            id="dropdownMenu"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            With Checked ({{ checked.length }})
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                            <a
                                href="#"
                                class="dropdown-item"
                                type="button"
                                onclick="confirm('Are you sure you wanna to delete the selected students?') || event.stopImmediatePropagation()"
                                @click.prevent="deleteStudents"
                            >
                                Delete
                            </a>
                            <a
                                :href="url"
                                class="dropdown-item"
                                type="button"
                            >
                                Export
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <search-field
                    v-model="search"
                    placeholder="Search by name,email,phone,or address..."
                >
                </search-field>
            </div>
        </div>

        <div class="col-md-10 mb-2" v-if="selectedStudentsOnPage">
            <div v-if="selectedAllStudents">
                You are currently selecting all
                <strong>{{ checked.length }}</strong> items.
            </div>
            <div v-else>
                You have selected <strong>{{ checked.length }}</strong> items,
                Do you want to Select All
                <strong>{{ students.meta.total }}</strong
                >?
                <a 
                    href="#"
                    class="ml-2"
                    @click.prevent="selectAllStudents"
                >
                    Select All
                </a>
            </div>
        </div>

        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <th>
                            <input type="checkbox" v-model="selectedStudentsOnPage" />
                        </th>
                        <th>
                            <a href="#" @click.prevent="changeSort('name')">Student's Name</a>
                            <span v-if="sortDiraction === 'desc' && sortField === 'name'">&uarr;</span>
                            <span v-if="sortDiraction === 'asc' && sortField === 'name'">&darr;</span>
                        </th>
                        <th>
                            <a href="#" @click.prevent="changeSort('email')">Email</a>
                            <span v-if="sortDiraction === 'desc' && sortField === 'email'">&uarr;</span>
                            <span v-if="sortDiraction === 'asc' && sortField === 'email'">&darr;</span>
                        </th>
                        <th>
                            <a href="#" @click.prevent="changeSort('address')">Address</a>
                            <span v-if="sortDiraction === 'desc' && sortField === 'address'">&uarr;</span>
                            <span v-if="sortDiraction === 'asc' && sortField === 'address'">&darr;</span>
                        </th>
                        <th>
                            <a href="#" @click.prevent="changeSort('phone_number')">Phone Number</a>
                            <span v-if="sortDiraction === 'desc' && sortField === 'phone_number'">&uarr;</span>
                            <span v-if="sortDiraction === 'asc' && sortField === 'phone_number'">&darr;</span>
                        </th>
                        <th>
                            <a href="#" @click.prevent="changeSort('created_at')">Created At</a>
                            <span v-if="sortDiraction === 'desc' && sortField === 'created_at'">&uarr;</span>
                            <span v-if="sortDiraction === 'asc' && sortField === 'created_at'">&darr;</span>
                        </th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Action</th>
                    </tr>

                    <tr v-for="student in students.data" :key="student.id" :class="isChecked(student.id) ? 'table-primary' : ''">
                        <td>
                            <input type="checkbox" :value="student.id" v-model="checked"/>
                        </td>
                        <td>{{ student.name }}</td>
                        <td>{{ student.email }}</td>
                        <td>{{ student.address }}</td>
                        <td>{{ student.phone_number }}</td>
                        <td>{{ student.created_at }}</td>
                        <td>{{ student.class }}</td>
                        <td>{{ student.section }}</td>
                        <td>
                            <button 
                                class="btn btn-danger btn-sm"
                                onclick="confirm('Are you sure you wanna to delete this student?') || event.stopImmediatePropagation()"
                                @click="deleteSingleStudent(student.id)"
                            >
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row mt-4">
            <div class="col-sm-6 offset-5">
                <pagination :data="students" @pagination-change-page="getStudents"></pagination>
            </div>
        </div>
    </div>
</template>

<script>
import PaginateSelect from "./PaginateSelect.vue"

export default {
    data() {
        return {
            students: {},
            paginate: 10,
            search: "",
            classes: {},
            selectedClass: '',
            selectedSection: '',
            sections: {},
            checked: [],
            selectedStudentsOnPage: false,
            selectedAllStudents: false,
            sortDiraction: 'desc',
            sortField: 'created_at',
            url: '',
        }
    },

    watch: {
        paginate: function(value) {
            this.getStudents()
        },
        search: function(value) {
            this.getStudents()
        },
        selectedClass: function(value) {
            axios.get(`api/sections?class_id=${this.selectedClass}`)
                .then((response) => {
                    this.sections = response.data.data
                })

            this.getStudents()
        },
        selectedSection: function(value) {
            this.getStudents()
        },
        selectedSection: function(value) {
            this.getStudents()
        },
        selectedStudentsOnPage: function(value) {
            this.checked = []

            if (value) {
                this.students.data.forEach(student => {
                    this.checked.push(student.id)
                })
            } else {
                this.checked = []
                this.selectedAllStudents = false
            }
        },
        checked: function(value) {
            this.url = `/api/students/export/${this.checked}`;
        }
    },

    methods: {
        getStudents(page = 1) {
            axios.get(`api/students?page=${page}&paginate=${this.paginate}&q=${this.search}&selectedClass=${this.selectedClass}&selectedSection=${this.selectedSection}&sort_diraction=${this.sortDiraction}&sort_field=${this.sortField}`)
                .then((response) => {
                    this.students = response.data
                })
        },
        isChecked(studentId) {
            return this.checked.includes(studentId)
        },
        deleteSingleStudent(studentId) {
            axios.delete(`api/students/${studentId}`)
                .then((response) => {
                    this.checked = this.checked.filter((id) => id != studentId)
                    this.$toast.success('Student Deleted Successfully')
                    this.getStudents()
                })
        },
        deleteStudents() {
            axios.delete(`api/students/mass-destroy/${this.checked}`)
                .then((response) => {
                    if (response.status === 204) {
                        this.$toast.success('Selected Students were Deleted Successfully')
                        this.checked = []
                        this.getStudents()
                    }
                })
        },
        selectAllStudents() {
            axios.get('api/students/all')
                .then((response) => {
                    this.checked = response.data
                    this.selectedAllStudents = true
                })
        },
        changeSort(field) {
            if (this.sortField === field) {
                this.sortDiraction = this.sortDiraction === 'asc' ? 'desc' : 'asc'
            } else {
                this.sortField = field
            }

            this.getStudents()
        }
    },

    mounted() {
        axios.get(`api/classes`)
            .then((response) => {
                this.classes = response.data.data
            })

        this.getStudents();
    }
}
</script>