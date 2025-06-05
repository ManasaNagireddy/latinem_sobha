import { defineStore } from 'pinia'

export const usePaginationStore = defineStore('pagination', {
  state: () => ({
    currentPage: 1,
    limit: 10,
    total: 0,
  }),
  getters: {
    offset: (state) => (state.currentPage - 1) * state.limit,
    totalPages: (state) => Math.ceil(state.total / state.limit),
  },
  actions: {
    nextPage() {
      if (this.currentPage < this.totalPages) this.currentPage++
    },
    prevPage() {
      if (this.currentPage > 1) this.currentPage--
    },
    goToPage(page) {
      this.currentPage = page
    },
    setTotal(total) {
      this.total = total
    },
  },
})
