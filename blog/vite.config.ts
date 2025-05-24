import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'
import path from 'path'

export default defineConfig({
  plugins: [react()],
  build: {
    outDir: 'dist',
    emptyOutDir: true,
    rollupOptions: {
      input: path.resolve(__dirname, 'assets/js/main.tsx'),
      output: {
        entryFileNames: 'main.js',
        assetFileNames: 'assets/[name].[ext]',
        format: 'iife', // WordPressで直接動く形式（IIFE＝即時関数）
      },
    },
  }
})
