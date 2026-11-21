import type { NextConfig } from "next";

/**
 * Static export for Hostinger shared hosting (Apache, public_html).
 *
 * `trailingSlash` is required. Without it, Next writes `contact.html` beside a
 * `contact.txt` payload. Apache on this account already has a `contact/`
 * directory (no index file). A directory wins over `contact.html`, so
 * `/contact` 301s to `/contact/` and that directory 403s.
 *
 * With `trailingSlash`, the route is `contact/index.html`. Uploading that
 * file into `public_html/contact/` makes `/contact/` a normal page.
 */
const nextConfig: NextConfig = {
  output: "export",
  trailingSlash: true,
  images: {
    unoptimized: true,
    remotePatterns: [
      {
        protocol: "https",
        hostname: "s.wordpress.com",
        pathname: "/mshots/**",
      },
    ],
  },
};

export default nextConfig;
