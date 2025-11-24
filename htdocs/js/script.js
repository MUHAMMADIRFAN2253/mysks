// ================================
//  SISTEM KONFIRMASI ADMIN
// ================================

let pendingElement = null;

function attachAdminInterceptor() {
  $(document).on("submit._adminConfirm", "form", function (e) {
    const $form = $(this);
    const insideModal = $form.closest(".modal").length > 0;

    if (!insideModal) return true;

    e.preventDefault();
    pendingElement = $form;

    const parentModal = $form.closest(".modal");
    parentModal.modal("hide");

    $("#confirmCredentialModal").data("lastModal", parentModal);

    $("#adminPassword").val("");
    $("#passwordError").hide();
    $("#confirmCredentialModalLabel").text("Konfirmasi Aksi Admin");

    const confirmModal = new bootstrap.Modal(
      document.getElementById("confirmCredentialModal")
    );
    confirmModal.show();
  });

  $(document)
    .off("click", "[data-aksi='hapus']")
    .on("click", "[data-aksi='hapus']", function (e) {
      e.preventDefault();
      pendingElement = $(this);

      $(".modal").modal("hide");
      $(".modal-backdrop").remove();
      $("body").removeClass("modal-open").css("padding-right", "");

      $("#adminPassword").val("");
      $("#passwordError").hide();
      $("#confirmCredentialModalLabel").text("Konfirmasi Aksi Admin");
      $("#confirmCredentialModal").data("lastModal", null);

      const confirmModal = new bootstrap.Modal(
        document.getElementById("confirmCredentialModal")
      );
      confirmModal.show();
    });
}

$("#confirmActionButton")
  .off("click")
  .on("click", function () {
    const password = $("#adminPassword").val();

    if (!password) {
      $("#passwordError").text("Password wajib diisi.").show();
      return;
    }

    $("#confirmActionButton")
      .prop("disabled", true)
      .html(
        '<span class="spinner-border spinner-border-sm"></span> Memeriksa...'
      );

    $.ajax({
      url: BASEURL + "/auth/verifyAdminPassword",
      method: "POST",
      data: { password },
      dataType: "json",
      success: function (response) {
        $("#confirmActionButton").prop("disabled", false).text("Lanjutkan");

        if (response.status === "success") {
          $(".modal").modal("hide");

          if (pendingElement && pendingElement.is("form")) {
            $(document).off("submit._adminConfirm");
            pendingElement[0].submit();

            setTimeout(() => attachAdminInterceptor(), 300);
          } else if (pendingElement && pendingElement.is("a")) {
            window.location.href = pendingElement.attr("href");
          }
        } else {
          $("#passwordError")
            .text(response.message || "Password salah.")
            .show();
        }
      },
      error: function () {
        $("#confirmActionButton").prop("disabled", false).text("Lanjutkan");
        $("#passwordError").text("Terjadi kesalahan koneksi server.").show();
      },
    });
  });

$("#confirmCredentialModal").on("hidden.bs.modal", function () {
  const lastModal = $(this).data("lastModal");

  $(".modal-backdrop").remove();
  $("body").removeClass("modal-open").css("padding-right", "");

  if (lastModal && !$(this).data("confirmed")) {
    lastModal.modal("show");
  }

  $(this).data("confirmed", false);
});

// =====================================
// AKTIFKAN / MATIKAN BERDASARKAN ROLE
// =====================================

if (USER_ROLE !== "admin") {
  console.log("Mode dosen terdeteksi — intercept admin dimatikan sepenuhnya.");
  $(document).off("submit._adminConfirm");
  $(document).off("click", "[data-aksi='hapus']");
  window.attachAdminInterceptor = function () {};
} else {
  console.log("Mode admin aktif — intercept password diaktifkan.");
  attachAdminInterceptor();
}

// =====================================
// FORM ABSENSI
// =====================================

$(document).on("click", ".tampilModalTambahAbsensi", function () {
  $("#formAbsensiLabel").text("Input Absensi");
  $("#formAbsensi form").attr(
    "action",
    BASEURL + "/Akademik/tambahAbsensiForm"
  );

  $(".modal-footer button[type=submit]").text("Simpan Absensi");

  $("#formAbsensi form")[0].reset();

  $('[name="id_absensi"]').val("");

  $("#formAbsensi").modal("show");
});

$(document).on("click", ".tampilModalUbahAbsensi", function () {
  const id_absensi = $(this).data("id_absensi");

  $("#formAbsensiLabel").text("Edit Absensi");
  $("#formAbsensi form").attr("action", BASEURL + "/Akademik/ubahAbsensiForm");

  $(".modal-footer button[type=submit]").text("Ubah Absensi");

  $("#formAbsensi form")[0].reset();

  $.ajax({
    url: BASEURL + "/Akademik/getUbahAbsensi",
    method: "post",
    data: { id_absensi: id_absensi },
    dataType: "json",
    success: function (data) {
      console.log(data);

      $('[name="id_absensi"]').val(data.id_absensi);
      $('[name="id_jadwal"]').val(data.id_jadwal);
      $('[name="nim_mahasiswa"]').val(data.nim_mahasiswa);
      $('[name="pertemuan_ke"]').val(data.pertemuan_ke);
      $('[name="tanggal_absensi"]').val(data.tanggal_absensi);
      $('[name="status_kehadiran"]').val(data.status_kehadiran);
      $('[name="keterangan"]').val(data.keterangan);

      $("#formAbsensi").modal("show");
    },
  });
});

// =====================================
// FORM PENGUMUMAN
// =====================================

$(document).on("click", ".tampilModalTambahPengumuman", function () {
  $("#formPengumumanLabel").text("Input Pengumuman");
  $("#formPengumuman form").attr(
    "action",
    BASEURL + "/Akademik/tambahPengumumanForm"
  );

  $(".modal-footer button[type=submit]").text("Tambah Pengumuman");

  $("#formPengumuman form")[0].reset();

  $('[name="id_pengumuman"]').val("");

  $("#formPengumuman").modal("show");
});

$(document).on("click", ".tampilModalUbahPengumuman", function () {
  const id_pengumuman = $(this).data("id_pengumuman");

  $("#formPengumumanLabel").text("Edit Pengumuman");
  $("#formPengumuman form").attr(
    "action",
    BASEURL + "/Akademik/ubahPengumumanForm"
  );

  $(".modal-footer button[type=submit]").text("Ubah Pengumuman");

  $("#formPengumuman form")[0].reset();

  $.ajax({
    url: BASEURL + "/Akademik/getUbahPengumuman",
    method: "post",
    data: { id_pengumuman: id_pengumuman },
    dataType: "json",
    success: function (data) {
      console.log(data);

      $('[name="id_pengumuman"]').val(data.id_pengumuman);
      $('[name="judul"]').val(data.judul);
      $('[name="isi_pengumuman"]').val(data.isi_pengumuman);

      $("#formPengumuman").modal("show");
    },
  });
});

// =====================================
// MODAL PENGABDIAN & PENELITIAN
// =====================================

$(function () {
  $(".tombolTambahData").on("click", function () {
    const currentPath = window.location.pathname;
    let actionUrl = "";
    let judulModal = "";

    if (currentPath.includes("pengabdian")) {
      actionUrl = BASEURL + "/Akademik/tambahPengabdian";
      judulModal = "Tambah Data Pengabdian";
    } else if (currentPath.includes("penelitian")) {
      actionUrl = BASEURL + "/Akademik/tambahPenelitian";
      judulModal = "Tambah Data Penelitian";
    }

    $("#judulModal").html(judulModal);
    $(".modal-footer button[type=submit]").html("Tambah Data");

    $("form").attr("action", actionUrl);

    $("form")[0].reset();
    $("#no").val("");
  });

  $(".tombolUbahPengabdian").on("click", function () {
    const id = $(this).data("id");

    $.ajax({
      url: BASEURL + "/Akademik/getUbahPengabdian",
      data: { no: id },
      method: "post",
      dataType: "json",
      success: function (data) {
        $("#judulModal").html("Ubah Data Pengabdian");
        $(".modal-footer button[type=submit]").html("Ubah Data");

        $("#no").val(data.no);
        $("#nip").val(data.nip);
        $("#nama_dosen").val(data.nama_dosen);
        $("#judul_pengabdian").val(data.judul_pengabdian);
        $("#aktivitas").val(data.aktivitas);

        $("form").attr("action", BASEURL + "/Akademik/ubahPengabdian");
      },
    });
  });

  $(".tombolUbahPenelitian").on("click", function () {
    const id = $(this).data("id");

    $.ajax({
      url: BASEURL + "/Akademik/getUbahPenelitian",
      data: { no: id },
      method: "post",
      dataType: "json",
      success: function (data) {
        $("#judulModal").html("Ubah Data Penelitian");
        $(".modal-footer button[type=submit]").html("Ubah Data");

        $("#no").val(data.no);
        $("#nip").val(data.nip);
        $("#nama_dosen").val(data.nama_dosen);
        $("#judul_penelitian").val(data.judul_penelitian);
        $("#aktivitas").val(data.aktivitas);

        $("form").attr("action", BASEURL + "/Akademik/ubahPenelitian");
      },
    });
  });
});
