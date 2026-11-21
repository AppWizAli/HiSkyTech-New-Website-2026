import type { Metadata } from "next";
import { BookCallButton, ContactMethods } from "@/components/ContactMethods";
import { InquiryForm } from "@/components/InquiryForm";
import { SocialLinks } from "@/components/SocialLinks";
import { SITE_URL } from "@/lib/site";

const title = "Contact HiSkyTech";
const description =
  "Email hiskytechs@gmail.com, message WhatsApp +92 318 6362759, or book a call. HiSkyTech builds AI receptionists, voice agents, and automation from Sargodha, Pakistan.";

export const metadata: Metadata = {
  title: { absolute: title },
  description,
  alternates: { canonical: `${SITE_URL}/contact/` },
  openGraph: {
    title,
    description,
    url: `${SITE_URL}/contact/`,
    images: [{ url: "/og.png", width: 1200, height: 630, alt: "Contact HiSkyTech" }],
  },
  twitter: {
    card: "summary_large_image",
    title,
    description,
    images: ["/og.png"],
  },
};

export default function ContactPage() {
  return (
    <main>
      <section className="relative py-24 md:py-32 border-b border-white/[0.05] overflow-hidden bg-grid-pattern">
        <div className="absolute top-1/4 left-1/4 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl pointer-events-none" />
        <div className="absolute top-1/3 right-10 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none" />
        <div className="max-w-7xl mx-auto px-6 relative">
          <div className="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">
            <div className="lg:col-span-5">
              <span className="text-xs uppercase font-mono tracking-widest text-blue-400 block mb-3">
                Get In Touch
              </span>
              <h1 className="text-3xl sm:text-4xl md:text-5xl font-bold tracking-tight text-white leading-[1.15] mb-5">
                Let&apos;s Build Something <span className="text-blue-500">Great</span> Together
              </h1>
              <p className="text-neutral-400 text-sm sm:text-base leading-relaxed max-w-md mb-8">
                Whether you&apos;re launching a mobile app, scaling your software, or need an AI
                receptionist that answers every call — our team at HiSkyTech is here to help. We
                typically respond within 24 hours.
              </p>
              <ContactMethods compact />
              <div className="mt-6">
                <BookCallButton />
              </div>
              <div className="mt-10">
                <span className="text-[11px] uppercase font-mono tracking-wider text-neutral-500 block mb-3">
                  Find Us Elsewhere
                </span>
                <SocialLinks />
              </div>
            </div>
            <div className="lg:col-span-7">
              <InquiryForm />
            </div>
          </div>
        </div>
      </section>
    </main>
  );
}
