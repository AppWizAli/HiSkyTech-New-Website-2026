"use client";

import { useState } from "react";
import { regions, services } from "@/lib/content";
import { EMAIL, FORM_ENDPOINT, WHATSAPP_URL } from "@/lib/site";

const fieldClass =
  "w-full px-4 py-3 rounded-lg bg-white/[0.03] border border-white/10 text-white text-sm placeholder:text-neutral-500 focus:outline-none focus:border-blue-500/50 transition-colors";
const labelClass = "text-xs font-medium text-neutral-300 mb-2 block";

function buildWhatsAppText(data: {
  name: string;
  email: string;
  company: string;
  url: string;
  phone: string;
  region: string;
  selected: string[];
  details: string;
}) {
  const lines = [
    "New Project Inquiry — HiSkyTech Website",
    "",
    `Name: ${data.name}`,
    `Email: ${data.email}`,
  ];
  if (data.company) lines.push(`Company: ${data.company}`);
  if (data.url) lines.push(`Company URL: ${data.url}`);
  if (data.phone) lines.push(`Phone: ${data.phone}`);
  if (data.region) lines.push(`Region: ${data.region}`);
  lines.push(`Services: ${data.selected.join(", ")}`, "", "Project Details:", data.details);
  return lines.join("\n");
}

export function InquiryForm() {
  const [name, setName] = useState("");
  const [email, setEmail] = useState("");
  const [company, setCompany] = useState("");
  const [url, setUrl] = useState("");
  const [phone, setPhone] = useState("");
  const [region, setRegion] = useState("");
  const [selected, setSelected] = useState<string[]>([]);
  const [details, setDetails] = useState("");
  const [serviceError, setServiceError] = useState(false);

  function toggle(title: string) {
    setSelected((current) =>
      current.includes(title) ? current.filter((item) => item !== title) : [...current, title],
    );
    setServiceError(false);
  }

  function onSubmit(event: React.FormEvent<HTMLFormElement>) {
    if (selected.length === 0) {
      event.preventDefault();
      setServiceError(true);
      return;
    }

    if (FORM_ENDPOINT) {
      return;
    }

    event.preventDefault();
    const text = buildWhatsAppText({ name, email, company, url, phone, region, selected, details });
    window.open(
      `${WHATSAPP_URL}?text=${encodeURIComponent(text)}`,
      "_blank",
      "noopener,noreferrer",
    );
  }

  return (
    <form
      onSubmit={onSubmit}
      action={FORM_ENDPOINT || `mailto:${EMAIL}`}
      method="POST"
      encType={FORM_ENDPOINT ? "application/x-www-form-urlencoded" : "text/plain"}
      className="hairline-card p-6 sm:p-8 space-y-5"
    >
      <div className="grid grid-cols-1 sm:grid-cols-2 gap-5">
        <div>
          <label className={labelClass} htmlFor="name">
            Your Name <span className="text-blue-400">*</span>
          </label>
          <input
            id="name"
            name="name"
            required
            type="text"
            placeholder="Your Name"
            value={name}
            onChange={(event) => setName(event.target.value)}
            className={fieldClass}
          />
        </div>
        <div>
          <label className={labelClass} htmlFor="email">
            Your Email <span className="text-blue-400">*</span>
          </label>
          <input
            id="email"
            name="email"
            required
            type="email"
            placeholder="Your Email"
            value={email}
            onChange={(event) => setEmail(event.target.value)}
            className={fieldClass}
          />
        </div>
      </div>
      <div className="grid grid-cols-1 sm:grid-cols-2 gap-5">
        <div>
          <label className={labelClass} htmlFor="company">
            Company Name
          </label>
          <input
            id="company"
            name="company"
            type="text"
            placeholder="Company Name"
            value={company}
            onChange={(event) => setCompany(event.target.value)}
            className={fieldClass}
          />
        </div>
        <div>
          <label className={labelClass} htmlFor="companyUrl">
            Company URL
          </label>
          <input
            id="companyUrl"
            name="companyUrl"
            type="url"
            placeholder="https://example.com"
            value={url}
            onChange={(event) => setUrl(event.target.value)}
            className={fieldClass}
          />
        </div>
      </div>
      <div className="grid grid-cols-1 sm:grid-cols-2 gap-5">
        <div>
          <label className={labelClass} htmlFor="phone">
            Phone Number
          </label>
          <input
            id="phone"
            name="phone"
            type="tel"
            placeholder="+1 415 555 0134"
            value={phone}
            onChange={(event) => setPhone(event.target.value)}
            className={fieldClass}
          />
        </div>
        <div>
          <label className={labelClass} htmlFor="region">
            Region
          </label>
          <select
            id="region"
            name="region"
            value={region}
            onChange={(event) => setRegion(event.target.value)}
            className={`${fieldClass} appearance-none`}
          >
            <option value="" className="bg-[#0e0e12]">
              Select Region
            </option>
            {regions.map((item) => (
              <option key={item} value={item} className="bg-[#0e0e12]">
                {item}
              </option>
            ))}
          </select>
        </div>
      </div>
      <div>
        <p className={labelClass}>
          Services You Are Looking For <span className="text-blue-400">*</span>
        </p>
        <div className="grid grid-cols-1 sm:grid-cols-2 gap-3">
          {services.map((service) => (
            <label
              key={service.title}
              className="badge-pill flex items-center gap-2.5 px-3.5 py-2.5 rounded-lg cursor-pointer"
            >
              <input
                type="checkbox"
                name="service"
                value={service.title}
                checked={selected.includes(service.title)}
                onChange={() => toggle(service.title)}
                className="w-4 h-4 accent-blue-500 shrink-0"
              />
              <span className="text-xs sm:text-sm text-neutral-300">{service.title}</span>
            </label>
          ))}
        </div>
        {serviceError && (
          <p className="text-xs text-rose-400 mt-2">Please select at least one service.</p>
        )}
      </div>
      <div>
        <label className={labelClass} htmlFor="details">
          Project Details <span className="text-blue-400">*</span>
        </label>
        <textarea
          id="details"
          name="details"
          required
          rows={4}
          placeholder="Write your project details"
          value={details}
          onChange={(event) => setDetails(event.target.value)}
          className={`${fieldClass} resize-none`}
        />
      </div>
      <button
        type="submit"
        className="w-full px-6 py-3 rounded-full bg-white text-black font-semibold text-sm hover:bg-neutral-200 transition-all flex items-center justify-center gap-2"
      >
        {FORM_ENDPOINT ? "Send inquiry" : "Send via WhatsApp"} <span>→</span>
      </button>
      <p className="text-xs text-neutral-500 leading-relaxed">
        {FORM_ENDPOINT
          ? "Submits to the configured form endpoint. "
          : "Opens WhatsApp with your inquiry. Without JavaScript this form emails us instead. "}
        Or write directly to{" "}
        <a className="text-neutral-300 hover:text-white" href={`mailto:${EMAIL}`}>
          {EMAIL}
        </a>
        .
      </p>
    </form>
  );
}
