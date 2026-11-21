import { EMAIL, LOCATION, PHONE_E164, SAME_AS, SITE_NAME, SITE_URL } from "@/lib/site";

export function JsonLd() {
  const data = {
    "@context": "https://schema.org",
    "@graph": [
      {
        "@type": "Organization",
        "@id": `${SITE_URL}/#organization`,
        name: SITE_NAME,
        url: SITE_URL,
        logo: `${SITE_URL}/logo.webp`,
        image: `${SITE_URL}/og.png`,
        email: EMAIL,
        telephone: PHONE_E164,
        address: {
          "@type": "PostalAddress",
          addressLocality: "Sargodha",
          addressRegion: "Punjab",
          addressCountry: "PK",
        },
        sameAs: SAME_AS,
      },
      {
        "@type": "LocalBusiness",
        "@id": `${SITE_URL}/#localbusiness`,
        name: SITE_NAME,
        url: SITE_URL,
        image: `${SITE_URL}/og.png`,
        email: EMAIL,
        telephone: PHONE_E164,
        address: {
          "@type": "PostalAddress",
          streetAddress: LOCATION,
          addressLocality: "Sargodha",
          addressRegion: "Punjab",
          addressCountry: "PK",
        },
        areaServed: ["US", "GB", "AU", "AE", "SA", "QA", "PK"],
        sameAs: SAME_AS,
      },
    ],
  };

  return (
    <script
      type="application/ld+json"
      dangerouslySetInnerHTML={{ __html: JSON.stringify(data) }}
    />
  );
}
