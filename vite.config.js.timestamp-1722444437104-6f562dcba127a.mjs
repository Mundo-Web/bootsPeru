// vite.config.js
import { defineConfig } from "file:///E:/carlo/Documents/Proyectos_de_Desarrollo/PPY_MUNDO_WEB/bootsPeru/node_modules/vite/dist/node/index.js";
import laravel from "file:///E:/carlo/Documents/Proyectos_de_Desarrollo/PPY_MUNDO_WEB/bootsPeru/node_modules/laravel-vite-plugin/dist/index.js";
import glob from "file:///E:/carlo/Documents/Proyectos_de_Desarrollo/PPY_MUNDO_WEB/bootsPeru/node_modules/glob/glob.js";
var vite_config_default = defineConfig({
  server: {
    watch: {
      ignored: ["!**/node_modules/your-package-name/**"]
    }
  },
  plugins: [
    laravel({
      input: [
        ...glob.sync("resources/js/**/*.jsx"),
        "resources/css/app.css",
        "resources/js/app.js"
      ],
      refresh: true
    })
  ],
  resolve: (name) => {
    const pages = import.meta.glob("./Pages/**/*.jsx", { eager: true });
    return pages[`./Pages/${name}.jsx`];
  }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJFOlxcXFxjYXJsb1xcXFxEb2N1bWVudHNcXFxcUHJveWVjdG9zX2RlX0Rlc2Fycm9sbG9cXFxcUFBZX01VTkRPX1dFQlxcXFxib290c1BlcnVcIjtjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfZmlsZW5hbWUgPSBcIkU6XFxcXGNhcmxvXFxcXERvY3VtZW50c1xcXFxQcm95ZWN0b3NfZGVfRGVzYXJyb2xsb1xcXFxQUFlfTVVORE9fV0VCXFxcXGJvb3RzUGVydVxcXFx2aXRlLmNvbmZpZy5qc1wiO2NvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9pbXBvcnRfbWV0YV91cmwgPSBcImZpbGU6Ly8vRTovY2FybG8vRG9jdW1lbnRzL1Byb3llY3Rvc19kZV9EZXNhcnJvbGxvL1BQWV9NVU5ET19XRUIvYm9vdHNQZXJ1L3ZpdGUuY29uZmlnLmpzXCI7aW1wb3J0IHsgZGVmaW5lQ29uZmlnIH0gZnJvbSAndml0ZSc7XG5pbXBvcnQgbGFyYXZlbCBmcm9tICdsYXJhdmVsLXZpdGUtcGx1Z2luJztcbmltcG9ydCBnbG9iIGZyb20gJ2dsb2InO1xuXG5leHBvcnQgZGVmYXVsdCBkZWZpbmVDb25maWcoe1xuICAgIHNlcnZlcjoge1xuICAgICAgICB3YXRjaDoge1xuICAgICAgICAgICAgaWdub3JlZDogWychKiovbm9kZV9tb2R1bGVzL3lvdXItcGFja2FnZS1uYW1lLyoqJ10sXG4gICAgICAgIH1cbiAgICB9LFxuICAgIHBsdWdpbnM6IFtcbiAgICAgICAgbGFyYXZlbCh7XG4gICAgICAgICAgICBpbnB1dDogW1xuICAgICAgICAgICAgICAgIC4uLmdsb2Iuc3luYygncmVzb3VyY2VzL2pzLyoqLyouanN4JyksXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9jc3MvYXBwLmNzcycsXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9qcy9hcHAuanMnLFxuICAgICAgICAgICAgXSxcbiAgICAgICAgICAgIHJlZnJlc2g6IHRydWUsXG4gICAgICAgIH0pLFxuICAgIF0sXG4gICAgcmVzb2x2ZTogbmFtZSA9PiB7XG4gICAgICAgIGNvbnN0IHBhZ2VzID0gaW1wb3J0Lm1ldGEuZ2xvYignLi9QYWdlcy8qKi8qLmpzeCcsIHsgZWFnZXI6IHRydWUgfSlcbiAgICAgICAgcmV0dXJuIHBhZ2VzW2AuL1BhZ2VzLyR7bmFtZX0uanN4YF1cbiAgICB9XG59KTtcbiJdLAogICJtYXBwaW5ncyI6ICI7QUFBb1ksU0FBUyxvQkFBb0I7QUFDamEsT0FBTyxhQUFhO0FBQ3BCLE9BQU8sVUFBVTtBQUVqQixJQUFPLHNCQUFRLGFBQWE7QUFBQSxFQUN4QixRQUFRO0FBQUEsSUFDSixPQUFPO0FBQUEsTUFDSCxTQUFTLENBQUMsdUNBQXVDO0FBQUEsSUFDckQ7QUFBQSxFQUNKO0FBQUEsRUFDQSxTQUFTO0FBQUEsSUFDTCxRQUFRO0FBQUEsTUFDSixPQUFPO0FBQUEsUUFDSCxHQUFHLEtBQUssS0FBSyx1QkFBdUI7QUFBQSxRQUNwQztBQUFBLFFBQ0E7QUFBQSxNQUNKO0FBQUEsTUFDQSxTQUFTO0FBQUEsSUFDYixDQUFDO0FBQUEsRUFDTDtBQUFBLEVBQ0EsU0FBUyxVQUFRO0FBQ2IsVUFBTSxRQUFRLFlBQVksS0FBSyxvQkFBb0IsRUFBRSxPQUFPLEtBQUssQ0FBQztBQUNsRSxXQUFPLE1BQU0sV0FBVyxJQUFJLE1BQU07QUFBQSxFQUN0QztBQUNKLENBQUM7IiwKICAibmFtZXMiOiBbXQp9Cg==
