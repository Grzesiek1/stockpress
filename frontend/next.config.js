/** @type {import('next').NextConfig} */
const nextConfig = {
  publicRuntimeConfig: {
    apiUrl: process.env.API_URL,
  },
  reactStrictMode: true,
  swcMinify: true,
}

module.exports = nextConfig
