/**
 * Canonical host. Both hiskytechs.com and www.hiskytechs.com currently
 * answer, with no redirect between them. This build treats the apex as
 * canonical and public/.htaccess 301s www to it.
 */
export const SITE_URL = "https://hiskytechs.com";

export const SITE_NAME = "HiSkyTech";

export const EMAIL = "hiskytechs@gmail.com";

export const PHONE_E164 = "+923186362759";
export const PHONE_DISPLAY = "+92 318 6362759";
export const WHATSAPP_URL = "https://wa.me/923186362759";

export const LOCATION = "Sargodha, Pakistan";
export const LOCATION_LONG = "Sargodha, Punjab, Pakistan";

/**
 * OWNER INPUT — paste the Calendly (or Cal.com) scheduling URL here.
 * Example: "https://calendly.com/hiskytech/intro"
 *
 * Leave this as an empty string until the real link exists. The Book a call
 * button then emails hiskytechs@gmail.com instead of pointing at a dead URL.
 */
export const CALENDLY_URL = "";

/**
 * OWNER INPUT — optional inquiry-form backend.
 *
 * Paste a full URL that accepts a browser POST (Formspree, Getform, Basin,
 * or similar). Leave this as an empty string to keep the static-safe default:
 * the form opens WhatsApp, and without JavaScript it falls back to mailto.
 *
 * Do not put a relative /api route here. This site is a static export and
 * Hostinger will not run a Next.js server.
 */
export const FORM_ENDPOINT = "";

export const SOCIAL_LINKS = [
  {
    label: "LinkedIn",
    href: "https://www.linkedin.com/company/hiskytech",
  },
  {
    label: "Instagram",
    href: "https://www.instagram.com/hisky_tech",
  },
  {
    label: "Facebook",
    href: "https://www.facebook.com/p/HiSky-Tech-61554879965194/",
  },
  {
    label: "TikTok",
    href: "https://www.tiktok.com/@hiskytech",
  },
  {
    label: "YouTube",
    href: "https://www.youtube.com/@HiSkyTech",
  },
] as const;

/** Profiles confirmed for schema.org sameAs. Instagram is omitted on purpose. */
export const SAME_AS = [
  "https://www.linkedin.com/company/hiskytech",
  "https://www.tiktok.com/@hiskytech",
  "https://www.youtube.com/@HiSkyTech",
  "https://www.facebook.com/p/HiSky-Tech-61554879965194/",
] as const;

export function bookCallHref() {
  if (CALENDLY_URL) return CALENDLY_URL;
  const subject = encodeURIComponent("Book a call with HiSkyTech");
  return `mailto:${EMAIL}?subject=${subject}`;
}

export function mailtoHref(subject = "Project inquiry — HiSkyTech") {
  return `mailto:${EMAIL}?subject=${encodeURIComponent(subject)}`;
}
